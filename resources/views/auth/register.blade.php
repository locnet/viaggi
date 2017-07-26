@extends('master')
@section('title','Somos mayoristas de viajes a Andalucia')
@section('meta_description','Andalusiandoviaggi vende tours y reservas de hoteles a agencias 
y particulares. Los mejores precios para hacer tours de Andalucia.')
@section('content')
<section class="search-form-container">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 login">
                <div class="panel">
                    <div class="panel-heading">
                        <h2 class="lato-300 text-center">Registro agencia</h2>
                        <h3 class="lato-300 text-center">¿Tienes una agencia de viajes? Has venido al sitio perfecto.
                            Tenemos mas de 15 años organizando tours de Andalucia.
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Nombre</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Appelido</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">

                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('nombre_agencia') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Nombre agencia</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="nombre_agencia"
                                     value="{{ old('nombre_agencia') }}">

                                    @if ($errors->has('nombre_agencia'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nombre_agencia') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Telefono</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="telefono"
                                     value="{{ old('telefono') }}">

                                    @if ($errors->has('telefono'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('telefono') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('web') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Web</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="web"
                                     value="{{ old('web') }}">

                                    @if ($errors->has('telefono'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('web') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Correo electronico</label>

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
                                <label class="col-md-4 control-label">Contraseña</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Confirmar contraseña</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i>Confirmar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
