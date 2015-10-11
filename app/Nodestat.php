<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nodestat extends Model
{
    protected $fillable = [
        'node_id',
        'isonline',
        'clientcount',
    ];
}
