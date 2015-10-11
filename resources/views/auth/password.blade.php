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
                    <h2>Passwort vergessen</h2>

                    <form method="POST" action="/password/email" class="form-horizontal">
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

                            <div class="button-login">
                                <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
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