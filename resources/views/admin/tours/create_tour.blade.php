@extends('admin_master')
@section('title','Home Page')
@section('tours','class="active"')
@section('customcss')
    <link rel="stylesheet" href="{{ asset('datepicker/css/datepicker.css') }}">
@stop

@section('content')
    
    <div class="page-header">
        <h1 class="text-center lato-300">Crea un nuevo tour - paso 1/2</h1>
    </div>
    <div class="col-md-12">
        {!! Form::open(['url' => '/admin/tours/intermedio']) !!}            
         
         <div class="row">
            <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                <div class="col-md-3 control-label">
                    {!! Form::label('titulo', 'Denumire tour:', array('class' => 'control-label')) !!}
                </div>
                <div class="col-md-9 col-xs-12">
                    {!! Form::text('titulo', old('titulo'),
                              [ 'class' => 'form-control admin-form']) !!}
                    {!! $errors->first('titulo', '<span class="help-block">:message</span>') !!}
                </div>              
            </div>
        </div>
        <div class="row">
            <div class="form-group{{ $errors->has('destino') ? ' has-error' : '' }}">
                <div class="col-md-3 control-label">
                    {!! Form::label('destino', 'Destino: ', array('class' => 'control-label')) !!}
                </div>
                <div class="col-md-3 col-xs-12">
                    {!! Form::select('destino', $destinos, old('destino'), 
                    ['class' => 'form-control admin-form']) !!}
                    {!! $errors->first('destino', '<span class="help-block">:message</span>') !!}
                </div>              
            </div>
        </div>
        <div class="row">
             <div class="form-group{{ $errors->has('visibility') ? ' has-error' : '' }}">
                <div class="col-md-3 col-xs-9 control-label">
                    {!! Form::label('visibility', 'Visibile en portada:', array('class' => 'control-label')) !!}
                </div>
                <div class="col-md-9 col-xs-3">
                    {!! Form::checkbox('visibility', old('visibility'), ['class' => 'form-control pull-right']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                <div class="col-md-3 col-xs-12 control-label">
                    <p> {!! Form::label('descripcion', 'Descripcion:', array('class' => 'control-label')) !!}</p>
                </div>
                <div class="col-md-9 col-xs-12">
                    <p> {!! Form::textarea('descripcion', old('descripcion'),
                         ['class' => 'form-control admin-form']) !!} </p>
                </div>
            </div>
        </div>
        <div class="row">
             <div class="form-group {{ $errors->has('start') ? 'has-error' : '' }}">
                <div class="col-md-3 col-xs-6">
                    <p>{!! Form::label('start', 'Fecha inicio:', array('class' => 'control-label')) !!} </p>
                </div>
                <div class="col-md-3 col-xs-6">
                    {!! Form::text('start', old('start'),
                    [ 'class' => 'form-control admin-form',
                      'id' => 'start',
                      'readonly']) !!}
                    {!! $errors->first('start', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group {{ $errors->has('fin') ? 'has-error' : '' }}">
                <div class="col-md-3 col-xs-6">
                    <p>{!! Form::label('fin', 'Fecha fin:', array('class' => 'control-label')) !!} </p>
                </div>
                <div class="col-md-3 col-xs-6">
                    {!! Form::text('fin', old('fin'),
                     [ 'class' => 'form-control admin-form',
                       'id' => 'fin',
                       'readonly']) !!}
                    {!! $errors->first('fin', '<span class="help-block">:message</span>') !!}
                </div>              
            </div>
        </div>
        <div class="row">
            <div class="form-group {{ $errors->has('dias') ? 'has-error' : '' }}">
                <div class="col-md-3 col-xs-6">
                    <p>{!! Form::label('dias', 'Dias del tour:', array('class' => 'control-label')) !!} </p>
                </div>
                <div class="col-md-3 col-xs-6">
                    {!! Form::text('dias', null, [ 'class' => 'form-control admin-form']) !!}
                    {!! $errors->first('dias', '<span class="help-block">:message</span>') !!}
                </div>              
            </div>
        </div>
        <div class="row">
            <div class="form-group {{ $errors->has('hoteles') ? 'has-error' : '' }}">
                <div class="col-md-3 col-xs-9">
                    <p>{!! Form::label('hoteles', 'Numero de hoteles:', array('class' => 'control-label')) !!} </p>
                </div>
                <div class="col-md-3 col-xs-3">
                    {!! Form::text('hoteles', null, [ 'class' => 'form-control admin-form']) !!}                   
                </div> 
            </div>
        </div>   

        <div class="form-group text-center">
            <p>{!! Form::submit('Siguiente', ['class' => 'btn btn-primary']) !!}</p>
        </div>
        
        {!! Form::close() !!}
    </div>
   
@stop
@section('customjs')

<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="{{ asset('datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('datepicker/js/locales/bootstrap-datepicker.es.js') }}"></script>
<script type="text/javascript">

/*
|-----------------------------------------------------------|
|              DATE PICKER                                  |
|-----------------------------------------------------------|
*/ 
    var checkin = $('#start').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        weekStart: 1,
        language: 'es'
        
    }).on('changeDate', function(ev) {
        if (checkin.getDate() > checkout.getDate()) {
            var newDate = new Date(checkin.getDate());
            newDate.setDate(newDate.getDate() + 1);console.log(newDate);
            checkout.setDate(newDate);
            // fecha final tiene que se por lo menos igual o mas grande que la fecha de inicio
            checkout.setStartDate(new Date(checkin.getDate()));

        }
        checkin.hide(); 
        $('#fin')[0].focus();

    }).data('datepicker');
    
    var checkout = $('#fin').datepicker({
        format: 'dd-mm-yyyy',
        weekStart: 1,
        language: 'es',
        
        onRender: function(date) {
            return date.dates.valueOf() <= checkin.dates.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        checkout.hide();
    }).data('datepicker');
    

</script>
@stop