<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $fillable = [
        'task_id',
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function task()
    {
        return $this->hasOne(\App\Task::class, 'id', 'task_id');
    }

    public function node()
    {
        return $this->task()->first()->hasOne(\App\Node::class, 'id', 'node_id');
    }
}
