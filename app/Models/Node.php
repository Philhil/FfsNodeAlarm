<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    use HasFactory;

    protected $fillable = [
        'mac',
        'name',
    ];

    public function stat()
    {
        return $this->hasOne(Nodestat::class);
    }
}
