@extends('master')
@section('title','Suscribe a nuestro boletin de ofertas | Los mejores tours de Andalucia ')
@section('contact','class="active"')
@section('content')
    <section class="search-form-container">
        <div class="container">
        	<div class="row">
				<div class="col-md-8 col-md-offset-2 col-xs-12">				
					<div class="panel">
	                    <div class="panel-heading">
	                    	<h2 class="lato-300 text-center">Newsletter</h2>
	                    	<h3 class="lato-300 text-center">Estamos creando continuamente cosas nuevas. Dejanos 
	                    		tu correo electronico, asi podremos avisarte de los ultimos tours y ofertas.</h3>
	                    </div>
	                    <div class="panel-body">
	                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/newsletter/store') }}">
	                            {!! csrf_field() !!}

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
	                           
	                            <div class="form-group">
	                                <div class="col-md-6 col-md-offset-4">
	                                    <button type="submit" class="btn btn-primary">
	                                        <i class="fa fa-btn fa-send"></i>Suscribir
	                                    </button>		                                    
	                                </div>
	                            </div>
	                        </form>                   
	                    </div>
	                </div>
				</div>
			</div>
		</div>
    </section>
@stop