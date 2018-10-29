<?php

namespace App\Services;
use Mail;

class StatusNotificationService
{

    public function notifyDown($task)
    {
        $this->fetchTaskData($task);

        $subject = $this->task->node->name . ' is Offline!';
        $this->sendNotificationMail($subject, 'emails.alarm');
    }

    public function notifyUp($task)
    {
        $this->fetchTaskData($task);

        $subject = $this->task->node->name . ' is back Online!';
        $this->sendNotificationMail($subject, 'emails.alarm-backonline');
    }

    private function fetchTaskData($task)
    {
        $this->task = $task;
        $this->user = \App\User::findOrFail($task->user_id);
    }

    private function sendNotificationMail($subject, $template)
    {
        $templateVariables = ['user' => $this->user, 'task' => $this->task];
        $emailRecipientAddress = $this->user->email;
        $emailRecipientName = $this->user->name;

        Mail::send($template, $templateVariables, function ($m) use ($emailRecipientAddress, $emailRecipientName, $subject) {
            $m->to($emailRecipientAddress, $emailRecipientName)->subject($subject);
        });
    }

    private function sendNotifcationSms($template) 
    {
        if ($this->task->smsalarm == 0 && !empty($this->user->mobilenumber)) {
        }
    }
}
