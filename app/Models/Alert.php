<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function task()
    {
        return $this->hasOne(Task::class, 'id', 'task_id');
    }
}
