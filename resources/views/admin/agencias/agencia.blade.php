@extends('admin_master')
@section('title','Precio barato hoteles | Reservar hotel barato')
@section('agencias','class="active"')
@section('content')
	<div class="container-fluid">		
        <h2 class="lato-300 text-center blue">Detalles agencia {{ $agencia->nombre_agencia }}</h2>
        <ul>
        	<li><p>Persona de contacto: {{ $agencia->name }}</p></li>
        	<li><p>Telefono de contacto: {{ $agencia->telefono }}</p></li>
        	<li><p>Email: {{ $agencia->email }}</p></li>
        	<li><p>Pagina web: 
        		@if (strlen($agencia->web) < 1)
        			N/D
    			@else
    				<a href="http://www.{{ $agencia->web }}">Ver</a>
				@endif
			</p></li>
        	<li><p>Registro confirmado: {{ $agencia->status === 1 ? "Si" : "No" }}</p></li>
            <li><p>
                ¿Mandar otra vez el recordatorio? <a href="{{ url('send-again/'.$agencia->confirmation_code) }}">
                <button  class="btn btn-success">Mandar</button></a>
        	</p></li>
        </ul>
        <h3 class="roboto pull-right"><a href="{{ url('admin/agencias') }}">
            <i class="fa fa-arrow-left"></i>Volver al listado</a>
        </h3>
	</div>
@stop