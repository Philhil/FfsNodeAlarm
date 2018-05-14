<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Services\StatusNotificationService;
use App\Services\TaskCheckService;

class checkTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkTasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check all Tasks and Trigger the in a Intervall';

    private $taskCheckService;

    public function __construct(TaskCheckService $taskCheckService)
    {
        parent::__construct();
        $this->taskCheckService = $taskCheckService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tasks = \App\Task::where(['active' => 0])->get();

        foreach($tasks as $task) {
            $this->taskCheckService->checkTask($task);
        }
    }


}
