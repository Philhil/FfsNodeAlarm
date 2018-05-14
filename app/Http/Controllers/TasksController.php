<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = \Auth::user()->task()->with('node')->get();
        $nodes = \App\Node::all();
        return view('tasks/index')->with('tasks', $tasks)->with('nodes', $nodes);
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
    public function store(Requests\TaskRequest $request)
    {
        $task = \App\Task::firstOrNew(['node_id' => $request->get('node_id'), 'user_id' => \Auth::user()->id]);
        $task->intervall = \Carbon\Carbon::createFromFormat('H:i',$request->get('intervall'))->toDateTimeString();
        $task->active = 0;
        if($request->get('smsalarm')){
            $task->smsalarm = $request->get('smsalarm') == 'on' ? 1 : 0;
        }

        $task->save();

        return $this->index();
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
        \App\Alert::where(['task_id' => $id])->delete();
        \App\Task::find($id)->delete();
        return $this->index();
    }
}
