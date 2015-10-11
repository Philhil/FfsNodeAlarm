<?php use Carbon\Carbon; ?>

@extends('_layouts.application')
@section('head')
@endsection

@section('content')
        <div class="row-fluid">
            <div class="box green span6">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon white edit"></i><span class="break"></span>Profile von {{$user->name}}</h2>
                    <div class="box-icon">
                        <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                    </div>
                </div>
                <div class="box-content">

                    <form method="POST" action="/profile" class="form-horizontal">
                        {!! csrf_field() !!}

                        <fieldset>
                            @if (count($errors) > 0)
                                <ul style="color: red">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="input-prepend" title="E-Mail">
                                <span class="add-on"><i class="halflings-icon envelope"></i></span>
                                <input class="input-large span10" type="email" name="email" value="{{ $user->email }}" readonly placeholder="E-Mail Adresse">
                            </div>
                            <div class="clearfix"></div>

                            <div class="input-prepend" title="Password">
                                <span class="add-on"><i class="halflings-icon lock"></i></span>
                                <input class="input-large span10" type="password" name="password" id="password" placeholder="Ihr Passwort">
                            </div>
                            <div class="clearfix"></div>

                            <div class="input-prepend" title="Name">
                                <span class="add-on"><i class="halflings-icon user"></i></span>
                                <input class="input-large span10" type="text" name="name" value="{{ $user->name }}" placeholder="Name">
                            </div>
                            <div class="clearfix"></div>

                            <div class="input-prepend" title="mobilenumber">
                                <span class="add-on"><i class="halflings-icon info-sign"></i></span>
                                <input class="input-large span10" type="text" name="mobilenumber" value="{{$user->mobilenumber}}" placeholder="Ihre Handynummer">
                            </div>
                            <div class="clearfix"></div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Speichern</button>
                            </div>
                            <div class="clearfix"></div>
                        </fieldset>
                    </form>
                </div>
            </div><!--/span-->

        </div><!--/row-->

@endsection