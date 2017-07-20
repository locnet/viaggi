@extends('admin_master')
@section('title','Detalles agencia | Enviar recordatorio')
@section('agencias','class="active"')
@section('content')
	<div class="conteiner">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <h2 class="lato-300 text-center blue">Detalles agencia {{ $agencia->nombre_agencia }}</h2>
                <ul>
                	<li><p>Persona de contacto: <span class="blue">{{ $agencia->name }}</span></p></li>
                	<li><p>Telefono de contacto: <span class="blue">{{ $agencia->telefono }}</span></p></li>
                	<li><p>Email: <span class="blue">{{ $agencia->email }}</span></p></li>
                	<li><p>Pagina web:
                		@if (strlen($agencia->web) < 1)
                			N/D
            			@else
            				<a href="http://www.{{ $agencia->web }}">Ver</a>
        				@endif
        			</p></li>
                	<li><p>Registro confirmado: <span class="blue">
                        {{ $agencia->status === 1 ? "Si" : "No" }}</span></p>
                    </li>
                </ul>
            </div>
            @if ($agencia->status === 0)
            <div class="col-sm-12 col-xs-12">
                <h4 class="lato-300">
                    La agencia todavia no ha confirmado su registro, tienes la posibilidad de mandarle un 
                    recordatorio.
                </h4>
                <p class="rotobo-300"> ¿Enviar recordatorio?
                    <a href="{{ url('send-again/'.$agencia->confirmation_code) }}">
                        <button class="btn btn-primary" style="margin-left:40px">Enviar</button>
                    </a> 
                </p>              
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3 class="lato-300"><a href="{{ url('admin/agencias') }}" class="blue">
                    <i class="fa fa-arrow-left"></i>Volver al listado</a>
                </h3>
            </div>
        </div>
	</div>
@stop