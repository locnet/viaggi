@extends('master')
@section('title','Eror de busqueda | Tenemos los mejores y  hoteles de las costas de Andalucia')
@section('meta_description','Hoteles baratos en Andalucia y los mejores tours, tenemos 
buenos precios en reservas de hotel.')
@section('hotel','class="active"')
@section('customcss')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-slider.css') }}">
@stop
@section('content')
    <div class="row">
    	<div class="col-md-10 col-md-offset-1 login">
		    <div class="row well well-lg">
		    	<h2 class="roboto text-center orange">
		    		Upsss! Parece que hemos tenido un problema al procesar el pago con tu 
		    		tarjeta. Por favor intentelo otra vez. Si el error persiste te rogamos
		    		que contactes con nosotros.
		    	</h2>
		    	
		    	<h3 class="text-center">
		    		<a href="{{ url('contact') }}">
				    	<button class="btn btn-warning">
				    		Contacta con nosotros
				    	</button>
				    </a>
			    </h3>
		    </div>
		</div>
	</div>
@endsection