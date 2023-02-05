<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Services\TaskCheckService;
use Illuminate\Console\Command;

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
    protected $description = 'FfsNodeAlarm: Check all Tasks and Trigger them in a intervall';

    private $taskCheckService;

    public function __construct(TaskCheckService $taskCheckService)
    {
        parent::__construct();
        $this->taskCheckService = $taskCheckService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tasks = Task::where(['active' => 0])->get();

        foreach($tasks as $task) {
            $this->taskCheckService->checkTask($task);
        }

        return Command::SUCCESS;
    }
}
