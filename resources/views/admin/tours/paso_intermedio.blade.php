@extends('admin_master')
@section('title','Home Page')
@section('tours','class="active"')
@section('customcss')
    <link rel="stylesheet" href="{{ asset('datepicker/css/datepicker.css') }}">
@stop

@section('content')
    
    <div class="page-header">
        <h1 class="text-center lato-300">La primera mitad esta hecha, vamos a por la segunda.</h1>
    </div>
    {{--  los datos del primer paso se guardan en la session --}}
    {{ Session::put('firstStepData',$data) }}

    <div class="col-md-12 text-center">
        <a href="{{ url('/admin/tours/paso-dos') }}">
        	<button class="btn btn-primary">Continuar</button>
        </a>
    </div>
@stop
