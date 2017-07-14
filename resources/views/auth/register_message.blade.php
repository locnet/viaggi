@extends('master')
@section('title','Confirmacion registro agencia en Andalusiando Viaggi')
@section('meta_description','Registra tu agencia en nuestra web para tener los mejores precios en 
hoteles y tours.')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2 class="lato-300 dark-blue text-center">{{$message}}</h2>
            	<h3 class="lato-300">Tus datos seran guardados en nuestra base de datos y nunca seran 
            	cedidos o compartidos con terceros. Puedes consultar nuestra politica de privacidad en 
                el enlace de abajo.
	            </h3>
	            <h4>
	            	<a href="{{ url('politica-de-privacidad') }}">Politica de privacidad </a>
	            </h4>
        	</div>

        </div>
    </div>
@endsection


