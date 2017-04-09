<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    protected $fillable = [
        'mac',
        'name',
    ];

    public function stat()
    {
        return $this->hasOne('App\Nodestat');
    }
}
