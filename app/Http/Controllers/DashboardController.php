<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mynodes = \App\Task::where('user_id', \Auth::user()->id)->count();
        $myonlinenodes = \App\Node::join('tasks', 'tasks.node_id', '=', 'nodes.id')->where('tasks.user_id', \Auth::user()->id)
            ->join('nodestats', 'nodestats.node_id', '=', 'nodes.id')
            ->where('nodestats.isonline', 1)->count();

        $procent =  $mynodes > 0 ? $myonlinenodes / $mynodes *100 : 0;

        $myclients = \App\Nodestat::join('tasks', 'tasks.node_id', '=', 'nodestats.node_id')->where('tasks.user_id', \Auth::user()->id)
            ->where('clientcount', '>', 0)->get();
        $myclients = $myclients->sum(function ($node) {
            return $node->clientcount;
        });

        return view('home/index')->with('mynodes', $mynodes)->with('onlineprocent', $procent)->with('myclients', $myclients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
