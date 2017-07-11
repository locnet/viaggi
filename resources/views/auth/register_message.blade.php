@extends('master')

@section('content')

    <div class="container">
        <div class="row">
        	<div class="alert alert-success login">
            	<h2 class="lato-300 dark-blue text-center">{{$message}}</h2>
            </div>
            <div class="col-md-8 col-md-offset-2">
            	<h3 class="lato-300">Tus datos seran guardados en nuestra base de datos y nunca seran 
            	cedidos o compartidos con terceros. Si quieres leer toda nuestra politica de privacidad 
                abajo te dejamos un enlace.  
	            </h3>
	            <h4>
	            	<a href="{{ url('auth/politica') }}">Politica de privacidad </a>
	            </h4>
        	</div>

        </div>
    </div>
@endsection


