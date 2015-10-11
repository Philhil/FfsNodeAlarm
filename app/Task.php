<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'node_id',
        'active',
        'intervall',
        'lastrun',
    ];

    public function node()
    {
        return $this->hasOne(\App\Node::class, 'id', 'node_id');
    }
}
