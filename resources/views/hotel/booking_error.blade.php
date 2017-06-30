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
		    		Upsss! Parece que no tenemos disponibilidad en el regimen deseado. Vamos a 
		    		intentarlo otra vez.
		    	</h2>
		    	<h4 class="roboto text-center dark-blue">
		    		@foreach($booking->getNodes('ERROR', false) as $error)
		    		    Codigo {{ $error['cod'] }} : {{ $error['msg'] }}
		    		@endforeach
		    	</h4>
		    	<h3 class="text-center">
		    		<a href="{{ url('hotel/search') }}">
				    	<button class="btn btn-success">
				    		Volver a buscar
				    	</button>
				    </a>
			    </h3>
		    </div>
		</div>
	</div>
@endsection