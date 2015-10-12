<?php use Carbon\Carbon; ?>

@extends('_layouts.application')
@section('head')
    <script>
        $(document).ready(function(){
            $('#timepicker2').timepicker({
                minuteStep: 10,
                template: 'modal',
                appendWidgetTo: 'body',
                showSeconds: false,
                showMeridian: false,
                defaultTime: false,
                defaultTime: '01:00',
            });
        });
    </script>
@endsection

@section('content')
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white edit"></i><span class="break"></span>Neuer Task</h2>
            <div class="box-icon">
                <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
            </div>
        </div>
        <div class="box-content">

            <form method="POST" action="/tasks"  class="form-horizontal">
                {!! csrf_field() !!}

                <fieldset>
                    @if (count($errors) > 0)
                        <ul style="color: red">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="input" title="Intervall">
                        <label class="control-label" for="selectNodes">Nodes:</label>
                        <div class="controls">
                            <select class="input-large span8" id="selectNodes" name="node_id"  data-rel="chosen">
                                @if (count($nodes) > 0)
                                    @foreach ($nodes as $node)
                                        <option value="{{$node->id}}">{{$node->name}} [{{$node->mac}}]</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="input" title="Intervall">
                        <label class="control-label" for="selectNodes"><i class="halflings-icon refresh"></i> Intervall (HH:mm):</label>
                        <div class=" controls input-group bootstrap-timepicker timepicker">
                            <input id="timepicker2" type="text" name="intervall"  class="input-smal span4">
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="input controls" title="smsalarm">
                        <label class="smsalarm"> <input type="checkbox" name="smsalarm"> Sms Alarm</label>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Speichern</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div><!--/span-->

</div><!--/row-->

<div class="row-fluid">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon white eye-open"></i><span class="break"></span>Tasks</h2>
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
                    <th>Intervall</th>
                    <th>Aktiv</th>
                    <th>zuletzt ausgeführt</th>
                    <th>Aktion</th>
                </tr>
                </thead>
                <tbody>

                @if (count($tasks) > 0)
                        @foreach ($tasks as $task)
                            <tr>
                                <td class="hidden">{{$task->node->mac}}</td>
                                <td>{{$task->node->name}} [{{$task->node->mac}}]</td>
                                <td class="center">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$task->intervall)->format('H:i')}}</td>
                                <td class="center">
                                    @if ($task->active == 0)
                                    <span class="label label label-success">Aktiv</span></td>
                                    @else
                                    <span class="label label-important">Inaktiv</span></td>
                                    @endif
                                <td class="center">
                                    @if ($task->lastrun != null)
                                    {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$task->lastrun)->diffForHumans(Carbon::Now())}}
                                    @endif
                                </td>
                                <td class="center">
                                    <!-- <a class="btn btn-info" href="#">
                                        <i class="halflings-icon white edit"></i>
                                    </a> -->
                                    <a class="btn btn-danger" href="/tasks/remove/{{$task->id}}">
                                        <i class="halflings-icon white trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div><!--/span-->
</div><!--/row-->

@endsection