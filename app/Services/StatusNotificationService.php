<?php

namespace App\Services;
use App\Mail\NodeOffline;
use App\Mail\NodeOnline;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Mail;

class StatusNotificationService
{
    private $user;

    public function notifyDown($task)
    {
        $this->fetchTaskData($task);
        Log::debug('Email Notification: OFFLINE notification for '.$task->node->name);
        $this->sendNotificationMail(new NodeOffline($task));
    }

    public function notifyUp($task)
    {
        $this->fetchTaskData($task);
        Log::debug('Email Notification: ONLINE notification for '.$task->node->name);
        $this->sendNotificationMail(new NodeOnline($task));
    }

    private function fetchTaskData($task)
    {
        $this->user = User::findOrFail($task->user_id);
    }

    private function sendNotificationMail($template)
    {
        $emailRecipientAddress = $this->user->email;
        $emailRecipientName = $this->user->name;

        Mail::to($emailRecipientAddress, $emailRecipientName)
            ->queue($template);
    }

    private function sendNotifcationSms($template)
    {
        if ($this->task->smsalarm == 0 && !empty($this->user->mobilenumber)) {
        }
    }
}
