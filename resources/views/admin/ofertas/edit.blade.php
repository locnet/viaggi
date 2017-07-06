@extends('admin_master')
@section('title','Home Page')
@section('tours','class="active"')
@section('customcss')
    <link rel="stylesheet" href="{{ asset('datepicker/css/datepicker.css') }}">
@stop

@section('content')
    
    <div class="page-header">
        <h1 class="text-center lato-300">Editar {{$oferta->titulo }}</h1>
    </div>
    <div class="col-md-12">
        {!! Form::open(['url' => '/admin/ofertas/update/'.$oferta->id, 'files' => 'true']) !!}            
         
         <div class="row">
            <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                <div class="col-md-3 control-label">
                    {!! Form::label('titulo', 'Titulo oferta:', array('class' => 'control-label')) !!}
                </div>
                <div class="col-md-9 col-xs-12">
                    {!! Form::text('titulo', $oferta->titulo,
                              [ 'class' => 'form-control admin-form']) !!}
                    {!! $errors->first('titulo', '<span class="help-block">:message</span>') !!}
                </div>              
            </div>
        </div>
        
        <div class="row">
            <div class="form-group{{ $errors->has('texto') ? ' has-error' : '' }}">
                <div class="col-md-3 col-xs-12 control-label">
                    <p> {!! Form::label('texto', 'Descripcion:', array('class' => 'control-label')) !!}</p>
                </div>
                <div class="col-md-9 col-xs-12">
                    <p> {!! Form::textarea('texto', $oferta->texto,
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
                    {!! Form::text('start', $oferta->start,
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
                    {!! Form::text('fin', $oferta->fin,
                     [ 'class' => 'form-control admin-form',
                       'id' => 'fin',
                       'readonly']) !!}
                    {!! $errors->first('fin', '<span class="help-block">:message</span>') !!}
                </div>              
            </div>
        </div>
        <div class="row hotelDetails">
            <div class="form-group {{ $errors->has('alojamiento') ? 'has-error' : '' }}">
                <div class="col-md-3 col-xs-4">
                    
                        {!! Form::label('alojamiento', 'Hotel ', array('class' => 'control-label')) !!}
                
                </div>
                <div class="col-md-3 col-xs-6">
                    {!! Form::text('alojamiento', $oferta->alojamiento,
                     [ 'class' => 'form-control  admin-form',
                       'id' => 'alojamiento' ]) !!}
                    {!! $errors->first('alojamiento', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="col-md-1 col-xs-2">
                    <button class="btn btn-primary showModal" data-toggle="modal" data-target="#hotelModal"
                            data-position="">
                                <span class="fa fa-search"></span>
                    </button>
                </div>
            </div>
        
            <div class="form-group {{ $errors->has('hotel_id') ? 'has-error' : '' }}">
                <div class="col-md-2 col-xs-4">
                    {!! Form::label('hotel_id', 'Id hotel', array('class' => 'control-label pull-right')) !!}                    
                </div>
                <div class="col-md-2 col-xs-4">
                    {!! Form::text('hotel_id',$oferta->hotel_id,
                     [ 'class' => 'form-control  admin-form',
                       'id' => 'hotel_id', "readonly" ]) !!}
                    {!! $errors->first('hotel_id', '<span class="help-block">:message</span>') !!}
                </div>  
            </div>
        </div>
        <div class="row">
            <div class="form-group {{ $errors->has('pdf') ? 'has-error' : '' }}">
                <div class="col-md-3 col-xs-12">
                    <p class="roboto dark-blue">
                        {!! Form::label('pdf', 'Presentacion PDF', array('class' => 'control-label')) !!}
                    </p>
                </div>
                <div class="col-md-6 col-xs-12">
                    {!! Form::file('pdf',  [ 'class' => 'form-control  admin-form','id' => 'pdf' ] ) !!}
                    {!! $errors->first('pdf', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group {{ $errors->has('foto') ? 'has-error' : '' }}">
                <div class="col-md-3 col-xs-12">                    
                        {!! Form::label('foto', 'Imagen', array('class' => 'control-label')) !!}                    
                </div>
                <div class="col-md-6 col-xs-12">
                    {!! Form::file('foto',  [ 'class' => 'form-control  admin-form', 'id' => 'foto']) !!}
                    {!! $errors->first('foto', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group {{ $errors->has('precio_agencias') ? 'has-error' : '' }}">
                <div class="col-md-3 col-xs-8">                    
                        {!! Form::label('precio_agencias', 'Precio agencias', array('class' => 'control-label')) !!}            
                </div>
                <div class="col-md-3 col-xs-4">
                    {!! Form::text('precio_agencias', $oferta->precio_agencias,
                     [ 'class' => 'form-control  admin-form']) !!}
                    {!! $errors->first('precio_agencias', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group {{ $errors->has('precio_publico') ? 'has-error' : '' }}">
                <div class="col-md-3 col-xs-8">                
                        {!! Form::label('precio_publico', 'Precio publico', 
                        array('class' => 'control-label')) !!}                    
                </div>
                <div class="col-md-3 col-xs-4">
                    {!! Form::text('precio_publico', $oferta->precio_publico,
                     [ 'class' => 'form-control  admin-form']) !!}
                    {!! $errors->first('precio_publico', '<span class="help-block">:message</span>') !!}
                </div>  
            </div>
        </div>

        <div class="form-group text-center">
            <p>{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}</p>
        </div>
        
        {!! Form::close() !!}
         @include('admin.tours._hotel_modal')
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
/*
|------------------------------------------------------|
|                  Modal busqueda hotel                         |
|------------------------------------------------------|
*/

$('.showModal').click(function(event){
    event.preventDefault();
    $('#hotelModal').show();
});
$('#searchHotel').click(function(event) {
   event.preventDefault();
});

var referenceBtn;           // el boton que llama el modal

$("#hotelModal").on('show.bs.modal', function(event) {
    referenceBtn = $(event.relatedTarget);
    var modal = $(this);
    $('#searchHotel').click(function(e){
        $.ajax({
            url: "{{ url('ver/hoteles/') }}" + "/" + $('#destino').val() + "/" + $('#zona').val() + "/edit",
            type: "GET",
            data: $("modal-form").serialize(),
            dataType: 'html',            
            success: function(data){
                // limpiamos la tabla con los resultados
                $('#resultTable').remove();
                var html_data = data;
                modal.find('.modal-body').append(html_data);
                
            },
            error: function(data){
                $('#errorText').text("Error! No se puede mostrar ningun hotel");
            }
        });
    })     
    
});

$("#hotelModal").on('hide.bs.modal', function(event) {
  
    // limpiamos la tabla con los resultados
    $('#resultTable').remove();

});

/**
* inserta los datos de los hotel seleccionado en el input corespondiente
* @param id, id hotel elegido
* @param name, nombre del hotel elegido
*/
var setHotel = function (id, name) {
    var position = referenceBtn.data('position');
    $('#alojamiento'+position).val(name);
    $('#hotel_id'+position).val(id);
}
 
/*|-------------------------------------------|
  |            MANIPULAR ZONAS                |
  |-------------------------------------------|*/
//objeto que contiene todas las zonas de la base de datos
    var z = new Object();
        @foreach ($idZonas as $id)
            {!! 
                'z['. $id->IdZona .'] = { nombreZona: "' . $id->NombreZona . 
                                          '", idZona: ' . $id->IdZona .
                                          ', idDestino: ' . $id->IdDestino . '};'                                 
            !!}
        @endforeach
   

    var zona = $("#zona");   //select zonas

    function setZones(){

        var selectedId = $("#destino option:selected").val();  // el destino selectado

        //limpio todas las opciones del select "zona"
        zona.empty().
        append($('<option>',{
            value: 0,
            text: "Todas las zonas"
        }));

        for (var id in z) {
            //añado solo las zonas pertenecientes al destino selectado
            if (z[id].idDestino == selectedId) {
                zona.append($('<option>', {
                    value: z[id].idZona,
                    text:  z[id].nombreZona
                }));
            }             
        }
    };
    setZones();
</script>
@stop