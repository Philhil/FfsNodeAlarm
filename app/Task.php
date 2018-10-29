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
        'offlinesince'
    ];

    public function node()
    {
        return $this->hasOne(\App\Node::class, 'id', 'node_id');
    }

    public function nodestat()
    {
        return $this->hasOne(\App\Nodestat::class, 'id', 'node_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

}
