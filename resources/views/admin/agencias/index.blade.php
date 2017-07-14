@extends('admin_master')
@section('title','Precio barato hoteles | Reservar hotel barato')
@section('agencias','class="active"')
@section('content')
<div class="">		
    <h2 class="lato-300 text-center blue">Listado agencias registradas</h2>
    <table class="table table-striped table-responsive">
        <tr>
            <th><h4 class="lato-300 blue">Agencia</h4></th>
            <th class="hidden-xs"><h4 class="lato-300 blue">Contacto</h4></th>
            <th class="hidden-xs"><h4 class="lato-300 blue">Telefono</h4></th>
            <th class="hidden-xs"><h4 class="lato-300 blue">Email</h4></th>
            <th><h4 class="lato-300 blue">Confirmada</h4></th>
            <th><h4 class="lato-300 blue"></h4></th>
        </tr>
        <tr>
        @foreach ($users as $user)
            <td><p>{{ $user->nombre_agencia }}</p></td>
            <td class="hidden-xs"><p>{{ $user->name }}</p></td>
            <td class="hidden-xs"><p>{{ $user->telefono }}</p></td>
            <td class="hidden-xs"><p>{{ $user->email}}</p></td>
            <td><p>{{ $user->status === 1 ? "Si" : "No" }}</p></td>
            <td><p><a href="{{ url('admin/agencia/'.$user->id) }}"><i class="fa fa-search"></i></a></p></td>
        </tr>
        @endforeach
    </table>
    {{-- menu paginacion --}}
    {!! $users->render() !!}
</div>
@stop