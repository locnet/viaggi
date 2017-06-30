@extends('master')

@section('content')
<section class="search-form-container">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 login">
                <div class="panel">
                    <div class="panel-heading">
                        <h2 class="lato-300 text-center">Bienvenido</h2>
                        <h3 class="lato-300 text-center">¿Tienes una cuenta de agencia?</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Recuerdame
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i>Login
                                    </button>

                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">¿Contraseña olvidada?</a>
                                </div>
                            </div>
                        </form>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <p class="orange roboto text-center">Nuevo por aqui?</p>
                                <a href="{{ url('/auth/register') }}">
                                    <button class="btn btn-primary col-md-12">
                                        Crea tu cuenta
                                    </button>
                                </a>
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
