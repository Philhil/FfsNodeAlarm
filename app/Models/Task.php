<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'node_id',
        'active',
        'intervall',
        'lastrun',
        'offlinesince'
    ];

    protected $dates = ['intervall', 'lastrun', 'offlinesince', 'lastalert', 'created_at', 'updated_at'];

    public function node()
    {
        return $this->hasOne(Node::class, 'id', 'node_id');
    }

    public function nodestat()
    {
        return $this->hasOne(Nodestat::class, 'node_id', 'node_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class, 'task_id');
    }

    public function alertsLast30Days()
    {
        return $this->hasMany(Alert::class, 'task_id')
            ->where('alerts.created_at', '>', Carbon::now()->subDays(30)->endOfDay());
    }
}
