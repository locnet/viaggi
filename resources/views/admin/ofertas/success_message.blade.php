@extends('admin_master')
@section('title','Home Page')
@section('tours','class="active"')
@section('customcss')
    <link rel="stylesheet" href="{{ asset('datepicker/css/datepicker.css') }}">
@stop

@section('content')
    
    <div class="page-header">
        
        	@if($success)
        	    <h1 class="text-center lato-300">¡Yuuuupi!</h1>
        	    <h3 class="lato-300 text-center">La oferta se ha {{ $message }} corectamente. Puedes verla en la pagina 
        	    	principal.
        	    </h3>
        	@else
        	    <h1 class="text-center lato-300">¡Oooooh!</h1>
        	    <h3 class="lato-300 text-center">La oferta no ha podiso ser {{ $message }} corectamente. Intentalo otra vez.
        	    </h3>
        	@endif 
    </div>

    <div class="col-md-12 text-center">
        <a href="{{ url('/admin/ofertas') }}">
        	<button class="btn btn-primary">Continuar</button>
        </a>
    </div>
@stop
