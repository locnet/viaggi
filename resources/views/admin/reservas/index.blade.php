@extends('admin_master')
@section('title','Detalles reserva | Andalusiando Viaggi Administration')
@section('reservas','class="active"')
@section('content')
<div class="">		
    <h2 class="lato-300 text-center blue">Listado reservas</h2>
    <table class="table table-striped table-responsive">
        <tr>
            <th><h4 class="lato-300 blue">Locata</h4></th>
            <th class="hidden-xs"><h4 class="lato-300 blue">Titular</h4></th>
            <th class="hidden-xs"><h4 class="lato-300 blue">Telefono</h4></th>
            <th class="hidden-xs"><h4 class="lato-300 blue">Email</h4></th>
            <th><h4 class="lato-300 blue">Precio</h4></th>
            <th><h4 class="lato-300 blue">Fecha reserva</h4></th>
            <th><h4 class="lato-300 blue"></h4></th>
        </tr>
        <tr>
        @foreach ($reservas as $reserva)
            <td><p>{{ $reserva->locata }}</p></td>
            <td class="hidden-xs"><p>{{ ucwords($reserva->name) }}</p></td>
            <td class="hidden-xs"><p>{{ $reserva->telefono }}</p></td>
            <td class="hidden-xs"><p>{{ $reserva->email}}</p></td>
            <td><p>{{ number_format($reserva->precio,2) }} €</p></td>
            <td><p>{{ $reserva->created_at }}</p></td>
            <td><a href="{{ url('admin/reservas/'.$reserva->locata) }}"<i class="fa fa-search"></i></a></td>
        </tr>
        @endforeach
    </table>
    {{-- menu paginacion --}}
    {!! $reservas->render() !!}
</div>
@stop