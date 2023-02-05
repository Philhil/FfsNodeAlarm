<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\Nodestat;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $lastNodestatUpdate = Nodestat::latest('updated_at')->first();
        if($lastNodestatUpdate)
        {
            $lastNodestatUpdate = ($lastNodestatUpdate->updated_at)->toDateTimeString();
        }

        $mynodes = Task::where('user_id', auth()->user()->id)->count();
        $myonlinenodes = Node::join('tasks', 'tasks.node_id', '=', 'nodes.id')->where('tasks.user_id', auth()->user()->id)
            ->join('nodestats', 'nodestats.node_id', '=', 'nodes.id')
            ->where('nodestats.isonline', 1)->count();

        $procent =  $mynodes > 0 ? round($myonlinenodes / $mynodes *100 ,2) : 0;

        $myclients = Nodestat::join('tasks', 'tasks.node_id', '=', 'nodestats.node_id')->where('tasks.user_id', auth()->user()->id)
            ->where('clientcount', '>', 0)->get();
        $myclients = $myclients->sum(function ($node) {
            return $node->clientcount;
        });

        $alertsLast30Days = auth()->user()->alerts()
                    ->where('alerts.created_at', '>', Carbon::now()->subDays(30)->endOfDay())
                    ->get();

        //alle tasks des Users welche in den letzten 30 Tage einen alarm hatten
        $tasksWithAltertsLast30Days =  auth()->user()->tasks()->with('node')->with('alertsLast30Days')
            ->where('tasks.lastalert', '>', Carbon::now()->subDays(30)->endOfDay())
            ->orderby('tasks.lastalert')
            ->get();

        return view('dashboard.index', ['mynodes' => $mynodes, 'onlineprocent' => $procent, 'myclients' => $myclients,
            'alertsLast30Days' => $alertsLast30Days, 'tasksWithAltertsLast30Days' => $tasksWithAltertsLast30Days, 'lastNodestatUpdate' => $lastNodestatUpdate]);
    }
}
