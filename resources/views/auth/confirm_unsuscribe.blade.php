@extends('master')
@section('title','Confirma tu registro en nuestra agencia')
@section('meta_description','Tours de Andalucia al mejor precio del mercado.')
@section('content')
    <div class="container" style="min-height:400px">
        <div class="row">
        	<div class="col-md-8 col-md-offset-2">
	            <h2 class="lato-300 dark-blue text-center">Te hecharemos de menos {{ ucwords($user->name) }}</h2>
				<h3 class="lato-300 orange text-center">¡Esto no sera lo mismo sin ti!</h3>
				<h4 class="lato-300">Solo tienes que pulsar el boton de abajo y tu registro se borrado de 
					nuestra base de datos.</h4>
			</div>
            <div class="col-md-8 col-md-offset-2 text-center">
            	<a href="{{ url('borrar/agencia/'.$user->id.'/'.$user->confirmation_code) }}">
            		<button class="btn btn-success">Borrar mis datos</button>
            	</a>
            </div>
        </div>
    </div>
@endsection