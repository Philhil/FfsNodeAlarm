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

    public function getIsonlineAttribute($value) 
    {
        return $value == 1;
    }

    public function setIsonlineAttribute($value)
    {
        if ($value) {
            $this->attributes['isonline'] = 1;
        } else {
            $this->attributes['isonline'] = 0;
        }
    }
}
