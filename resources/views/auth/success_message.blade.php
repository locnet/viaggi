@extends('master')
@section('title','Confirma tu registro en nuestra agencia')
@section('meta_description','Tours de Andalucia al mejor precio del mercado.')
@section('content')
    <div class="container" style="min-height:400px">
        <div class="row">
        	<div class="col-md-8 col-md-offset-2">
	            <h2 class="lato-300 blue text-center">Gracias por registrate, {{ ucwords($user->name) }}</h2>
				<h3 class="lato-300">Hemos mandado un correo electonico con la confirmacion de tu registro. 
					Por favor, sigue las instrucciones que te hemos mandado para confirmar tu 
					registro.
				</h3>
				<h4 class="lato-300">Si no encuentras nuestro correo electronico en tu bandeja de entrada 
					conviene mirar en la carpeta de correo no deseado (spam).
				</h4>
			</div>
        </div>
    </div>
@endsection