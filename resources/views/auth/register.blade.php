@extends('_layouts.base')

@section('head')
@endsection

@section('body')
    <body>
    <div class="container-fluid-full">
        <div class="row-fluid">

            <div class="row-fluid">
                <div class="login-box">
                    <div class="icons">
                        <a href="/home"><i class="halflings-icon off"></i>Login</a>
                    </div>
                    <h2>Registrieren</h2>

                    <form method="POST" action="/auth/register" class="form-horizontal">
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
                                <span class="add-on"><i class="halflings-icon user"></i></span>
                                <input class="input-large span10" type="text" name="name" value="{{ old('name') }}" placeholder="Ihr (nick) Name">
                            </div>
                            <div class="clearfix"></div>

                            <div class="input-prepend" title="E-Mail">
                                <span class="add-on"><i class="halflings-icon envelope"></i></span>
                                <input class="input-large span10" type="email" name="email" value="{{ old('email') }}" placeholder="E-Mail Adresse">
                            </div>
                            <div class="clearfix"></div>

                            <div class="input-prepend" title="Password">
                                <span class="add-on"><i class="halflings-icon lock"></i></span>
                                <input class="input-large span10" type="password" name="password" id="password" placeholder="Ihr Passwort">
                            </div>
                            <div class="clearfix"></div>

                            <div class="input-prepend" title="Password bestätigen">
                                <span class="add-on"><i class="halflings-icon lock"></i></span>
                                <input class="input-large span10" type="password" name="password_confirmation" id="password" placeholder="Passwort bestätigen">
                            </div>
                            <div class="clearfix"></div>

                            <div class="button-login">
                                <button type="submit" class="btn btn-primary">Registrieren</button>
                            </div>
                            <div class="clearfix"></div>
                        </fieldset>
                    </form>
                </div><!--/span-->
            </div><!--/row-->

        </div><!--/fluid-row-->
    </div><!--/.fluid-container-->

    </body>
@endsection