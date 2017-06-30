@extends('admin_master')
@section('title','Precio barato hoteles | Reservar hotel barato')
@section('procentajes','class="active"')
@section('content')
	<div class="container-fluid">
		
        @if ($message)
            <div class="alert alert-success">
                <h3 class="lato-300 text-center">{{ $message }}</h3>
            </div>
        @else
            <div class="alert alert-succes">
                <h3 class="lato-300 text-center">Los procentajes actuales</h3>
            </div>
        @endif
        
        {!! Form::open(['url' => '/admin/procentajes/editar/'.$procent->id]) !!}            
        {{ csrf_field() }}
         <div class="row">
            <div class="form-group{{ $errors->has('agencias') ? ' has-error' : '' }}">
                <div class="col-md-3 control-label">
                    {!! Form::label('agencias', 'Procentaje para agencias:', array('class' => 'control-label')) !!}
                </div>
                <div class="col-md-1 col-xs-12">
                    {!! Form::text('agencias', $procent->agencias,
                              [ 'class' => 'form-control admin-form']) !!}
                    
                </div>              
            </div>
        </div>
        <div class="row">
            <div class="form-group{{ $errors->has('publico') ? ' has-error' : '' }}">
                <div class="col-md-3 control-label">
                    {!! Form::label('publico', 'Procentaje para el publico: ', array('class' => 'control-label')) !!}
                </div>
                <div class="col-md-1 col-xs-12">
                    {!! Form::text('publico', $procent->publico, 
                    ['class' => 'form-control admin-form']) !!}
                </div>              
            </div>
        </div>

        <div class="form-group text-center">
            <p>{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}</p>
        </div>
        {!! Form::close() !!}
	</div>
@stop