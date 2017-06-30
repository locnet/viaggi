@extends('admin_master')
@section('title','Precio barato hoteles | Reservar hotel barato')
@section('agencias','class="active"')
@section('content')
	<div class="container-fluid">		
        <h2 class="lato-300 text-center blue">Detalles agencia {{ $agencia->nombre_agencia }}</h2>
        <ul>
        	<li><p>Persona de contacto: {{ $agencia->nombre }}</p></li>
        	<li><p>Telefono de contacto: {{ $agencia->telefono }}</p></li>
        	<li><p>Email: {{ $agencia->email }}</p></li>
        	<li><p>Pagina web: 
        		@if (strlen($agencia->web) < 1)
        			N/D
    			@else
    				<a href="http://{{ $agencia->web }}">Ver</a>
				@endif
			</p></li>
        	<li><p>Registro confirmado:
            	{{ $agencia->status === 1 ? "Si" : "No" }}
        	</p></li>
        </ul>
        
	</div>
@stop