<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;

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

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tasks = \App\Task::where(['active' => 0])->get();

        $now = \Carbon\Carbon::now();

        foreach($tasks as $task){
            $check = false;

            if($task->lastrun != null){
                $checkdate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$task->lastrun);
                $intervall = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$task->intervall);
                $checkdate->addHours($intervall->hour)->addMinutes($intervall->minute);

                if($checkdate->lte($now)){
                    $check = true;
                }
            } else {
                $check = true;
            }

            if($check){
                $nodestat = \App\Nodestat::where('node_id', $task->node_id)->first();

                if($nodestat != null && $nodestat->isonline == 1){
                    if($task->lastalert != null && $task->lastrun == $task->lastalert) {
                        continue;
                    }

                    $user = \App\User::findOrFail($task->user_id);
                    Mail::send('emails.alarm', ['user' => $user, 'task' => $task], function ($m) use ($user, $task) {
                        $m->to($user->email, $user->name)->subject($task->node->name . ' is Offline!');
                    });

                    if($task->smsalarm == 0 && !empty($user->mobilenumber)) {
                        //TODO: write sms
                    }

                    \App\Alert::insert(['task_id' => $task->id]);

                    $task->lastalert = $now;
                }

                $task->lastrun = $now;
                $task->save();
            }
        }

    }
}
