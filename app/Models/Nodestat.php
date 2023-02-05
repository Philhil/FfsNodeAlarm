<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nodestat extends Model
{
    use HasFactory;

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
