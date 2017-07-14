@extends('admin_master')
@section('title','Precio barato hoteles | Reservar hotel barato')
@section('agencias','class="active"')
@section('content')
	<div class="conteiner">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
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
                    @if ($agencia->status === 0)
                        <li><p>
                            ¿Mandar recordatorio? <a href="{{ url('send-again/'.$agencia->confirmation_code) }}">
                            <button  class="btn btn-success" style="margin-left:15px">Mandar</button></a>
                    	</p></li>
                    @endif
                </ul>
                <h3 class="lato-300"><a href="{{ url('admin/agencias') }}" class="blue">
                    <i class="fa fa-arrow-left"></i>Volver al listado</a>
                </h3>
            </div>
        </div>
	</div>
@stop