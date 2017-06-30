@extends('admin_master')
@section('title','Precio barato hoteles | Reservar hotel barato')
@section('agencias','class="active"')
@section('content')
	<div class="container-fluid table-responsive">		
        <h2 class="lato-300 text-center blue">Listado agencias registradas</h2>
        <table class="table table-striped table-responsive">
        	<tr>
	        	<th><h4 class="lato-300 blue">Agencia</h4></th>
	        	<th><h4 class="lato-300 blue">Contacto</h4></th>
	        	<th><h4 class="lato-300 blue">Telefono</h4></th>
	        	<th><h4 class="lato-300 blue">Email</h4></th>
	        	<th><h4 class="lato-300 blue"></h4></th>
	        </tr>
        	@foreach ($agencias as $agencia)
        		<td><p>{{ $agencia->nombre_agencia }}</p></td>
        		<td><p>{{ $agencia->nombre }}</p></td>
        		<td><p>{{ $agencia->telefono }}</p></td>
        		<td><p>{{ $agencia->email}}</p></td>
        		<td><p><a href="{{ url('admin/agencia/'.$agencia->id) }}">Ver Mas</a></p></td>
        	</tr>
        	@endforeach
        </table>
        {{-- menu paginacion --}}
        {!! $agencias->render() !!}
	</div>
@stop