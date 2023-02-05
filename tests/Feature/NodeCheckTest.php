<?php

namespace Tests\Feature;

use App\Models\Node;
use App\Models\Nodestat;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Services\TaskCheckService;
use Tests\TestCase;

class NodeCheckTest extends TestCase
{
    use DatabaseTransactions;

    public function testNodeIsUpAndNoNotificationHappens()
    {
        $this->createActiveTask();

        $nodestat = Nodestat::factory()->make(['isonline' => true]);
        $this->task->node->stat()->save($nodestat);

        $this->createNotificationMock();
        $this->mockEnsureNoNotificationIsSent();

        $taskCheckService = new TaskCheckService($this->notificationMock);
        $taskCheckService->checkTask($this->task);

        $this->assertNull($this->task->offlinesince);
    }

    public function testOfflineSinceIsCorrectlySaved()
    {
        $this->createActiveTask();

        $nodestat = Nodestat::factory()->make(['isonline' => false]);
        $this->task->node->stat()->save($nodestat);

        $this->createNotificationMock();
        $this->mockEnsureNoNotificationIsSent();

        $taskCheckService = new TaskCheckService($this->notificationMock);
        $taskCheckService->checkTask($this->task);

        $this->assertNotNull($this->task->offlinesince);
        // TODO: check time
    }

    public function testOfflineNotificationIsNotTriggeredBeforeCheckInterval()
    {
        $this->createActiveTask();
        $this->setTaskCheckInterval(0, 15);
        $this->setTaskOfflineSinceRelativeToNow(0, 10);

        $nodestat = Nodestat::factory()->make(['isonline' => false]);
        $this->task->node->stat()->save($nodestat);

        $this->createNotificationMock();
        $this->mockEnsureNoNotificationIsSent();

        $taskCheckService = new TaskCheckService($this->notificationMock);
        $taskCheckService->checkTask($this->task);

        $this->assertNotNull($this->task->offlinesince);
        // TODO: check time
    }

    public function testOfflineNotificationIsNotTriggeredTwice()
    {
        $this->createActiveTask();
        $this->setTaskCheckInterval(0, 15);
        $this->setTaskOfflineSinceRelativeToNow(0, 32);

        $nodestat = Nodestat::factory()->make(['isonline' => false]);
        $this->task->node->stat()->save($nodestat);

        $this->createNotificationMock();
        $this->mockEnsureDownNotificationIsSent();

        $taskCheckService = new TaskCheckService($this->notificationMock);
        $taskCheckService->checkTask($this->task);

        $this->assertNotNull($this->task->offlinesince);
        // TODO: check time

        $taskCheckService->checkTask($this->task);
        $this->assertNotNull($this->task->offlinesince);
    }

    public function testOfflineNotificationIsTriggeredAfterCheckInterval()
    {
        $this->createActiveTask();
        $this->setTaskCheckInterval(0, 15);
        $this->setTaskOfflineSinceRelativeToNow(0, 16);

        $nodestat = Nodestat::factory()->make(['isonline' => false]);
        $this->task->node->stat()->save($nodestat);

        $this->createNotificationMock();
        $this->mockEnsureDownNotificationIsSent();

        $taskCheckService = new TaskCheckService($this->notificationMock);
        $taskCheckService->checkTask($this->task);

        $this->assertNotNull($this->task->offlinesince);
        // TODO: check time
    }

    public function testOnlineNotificationIsTriggeredWhenNodeComesBackOnline()
    {
        $this->createActiveTask();
        $this->setTaskCheckInterval(0, 15);
        $this->setTaskOfflineSinceRelativeToNow(0, 16);

        $nodestat = Nodestat::factory()->make(['isonline' => false]);
        $this->task->node->stat()->save($nodestat);

        $this->createNotificationMock();
        $this->mockEnsureDownAndThenUpNotificationIsSent();

        $taskCheckService = new TaskCheckService($this->notificationMock);
        $taskCheckService->checkTask($this->task);

        $this->assertNotNull($this->task->offlinesince);
        // TODO: check time

        $this->setNodeOnline();
        $taskCheckService->checkTask($this->task);

        $this->assertNull($this->task->offlinesince);
    }

    public function testNotificationsAreNotTriggeredWhenNodeIsOfflineLessThanCheckInterval()
    {
        $this->createActiveTask();
        $this->setTaskCheckInterval(0, 15);
        $this->setTaskOfflineSinceRelativeToNow(0, 3);

        $nodestat = Nodestat::factory()->make(['isonline' => false]);
        $this->task->node->stat()->save($nodestat);

        $this->createNotificationMock();
        $this->mockEnsureNoNotificationIsSent();

        $taskCheckService = new TaskCheckService($this->notificationMock);
        $taskCheckService->checkTask($this->task);

        $this->assertNotNull($this->task->offlinesince);
        // TODO: check time

        $this->setNodeOnline();

        $taskCheckService->checkTask($this->task);

        $this->assertNull($this->task->offlinesince);
    }

    private function createActiveTask()
    {
        $user = User::factory()->create();

        $node = Node::factory()->create();

        $this->task = Task::factory()->state([
            'node_id' => $node->id,
            'user_id' => $user->id
        ])->create();
    }

    private function setTaskCheckInterval($hours, $minutes)
    {
        $this->task->intervall = \Carbon\Carbon::createFromTime(0, 15);
        $this->task->save();
    }

    private function setTaskOfflineSinceRelativeToNow($hours, $minutes)
    {
        $now = \Carbon\Carbon::now();
        $offlinesince = $now->addHours(-$hours)->addMinutes(-$minutes);

        $this->task->offlinesince = $offlinesince;
        $this->task->save();
    }

    private function setNodeOnline()
    {
        $this->task->node->stat->isonline = true;
        $this->task->node->stat->save();
    }

    private function createNotificationMock()
    {
        $this->notificationMock = \Mockery::mock('App\Services\StatusNotificationService');
    }

    private function mockEnsureNoNotificationIsSent()
    {
        $this->notificationMock->shouldNotReceive('notifyUp');
        $this->notificationMock->shouldNotReceive('notifyDown');
    }

    private function mockEnsureDownNotificationIsSent()
    {
        $this->notificationMock->shouldNotReceive('notifyUp');
        $this->notificationMock->shouldReceive('notifyDown')
            ->once()
            ->withArgs([$this->task]);
    }

    private function mockEnsureDownAndThenUpNotificationIsSent()
    {
        $this->notificationMock->shouldReceive('notifyDown')
            ->once()
            ->withArgs([$this->task])
            ->ordered();

        $this->notificationMock->shouldReceive('notifyUp')
            ->once()
            ->withArgs([$this->task])
            ->ordered();
    }

}
