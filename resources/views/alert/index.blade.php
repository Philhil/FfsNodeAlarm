<?php use Carbon\Carbon; ?>

@extends('_layouts.application')
@section('head')
@endsection

@section('content')
    <div class="sortable"> <!-- sortable -->
        <div class="row-fluid">
            <div class="box orange span12">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon white eye-open"></i><span class="break"></span>Alarm History</h2>
                    <div class="box-icon">
                        <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                        <thead>
                        <tr>
                            <th class="hidden">id</th>
                            <th>Node</th>
                            <th>Datum</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if (count($alerts) > 0)
                            @foreach ($alerts as $alert)
                                <tr>
                                    <td class="hidden">{{$alert->id}}</td>
                                    <td>{{$alert->node->name}} [{{$alert->node->mac}}]</td>
                                    <td class="center">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$alert->created_at)->toDayDateTimeString()}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div><!--/span-->
        </div><!--/row-->

    </div> <!-- /sortable -->
@endsection