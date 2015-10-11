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
                        <a href="/auth/register"><i class="halflings-icon user"></i>Registrieren</a>
                    </div>
                    <h2>Bitte einloggen</h2>


                    <form method="POST" action="/auth/login" class="form-horizontal">
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
                                <input class="input-large span10" type="email" name="email" value="{{ old('email') }}" placeholder="E-Mail Adresse">
                            </div>
                            <div class="clearfix"></div>

                            <div class="input-prepend" title="Password">
                                <span class="add-on"><i class="halflings-icon lock"></i></span>
                                <input class="input-large span10" type="password" name="password" id="password" placeholder="Ihr Passwort">
                            </div>
                            <div class="clearfix"></div>

                            <label class="remember"> <input type="checkbox" name="remember"> Remember Me</label>

                            <div class="button-login">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                            <div class="clearfix"></div>
                        </fieldset>
                    </form>

                    <hr>
                    <h3>Passwort vergessen?</h3>
                    <p>
                        Kein Problem, <a href="/auth/password">hier klicken</a>.
                    </p>
                </div><!--/span-->
            </div><!--/row-->

        </div><!--/fluid-row-->
    </div><!--/.fluid-container-->

    </body>
@endsection