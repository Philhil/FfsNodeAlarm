<?php

namespace App\Http\Controllers;

use App\Node;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($mac)
    {
        $node = \App\Node::where('mac', $mac)->first();
        if ($node) {
            return response()->json($node->stat()->get());
        }

        return response()->json();
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

    public function clients($mac)
    {
        $node = \App\Node::where('mac', $mac)->first();
        if ($node) {
            return response()->json($node->stat()->select('clientcount')->get());
        }

        return response()->json();
    }

    public function isOnline($mac)
    {
        $node = \App\Node::where('mac', $mac)->first();
        if ($node) {
            return response()->json($node->stat()->select('isonline')->get());
        }

        return response()->json();
    }
}
