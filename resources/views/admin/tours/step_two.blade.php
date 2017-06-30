@extends('admin_master')
@section('title','Home Page')
@section('tours','class="active"')
@section('customcss')
    <link rel="stylesheet" href="{{ asset('datepicker/css/datepicker.css') }}">
@stop

@section('content')
    
    <div class="page-header">
        <h1 class="text-center lato-300">Nuevo tour - paso 2 de 2</h1>
    </div>
    <div class="col-md-12">
        {!! Form::open(['url' => '/admin/tours/guardar', 'id' => 'stepTwoForm', 'files' => 'true']) !!}            
        
        {{ csrf_field() }}
        {{-- numero de dias y hoteles del paso uno --}}
        {!! Form::hidden('dias',$data['dias'], ['id' => 'dias']) !!}
        {!! Form::hidden('hoteles',$data['hoteles'], ['id' => 'hoteles']) !!}

        {{-- creamos un texarea para la descripcion de cada dia --}}

        @for($i=0; $i < $data['dias']; $i++)
        <div class="row">
            <div class="form-group {{ $errors->has('dia'.($i+1)) ? 'has-error' : '' }}">
                <div class="col-md-3 col-xs-12">
                    <p class="roboto dark-blue">
                        {!! Form::label('dia'.($i+1), 'Descripcion dia  '.($i+1), array('class' => 'control-label')) !!}
                    </p>
                </div>
                <div class="col-md-9 col-xs-12">
                    {!! Form::textarea('dia'.($i+1), old(('dia'.($i+1))), 
                    [ 'class' => 'form-control  admin-form', 'id' => 'dia'.($i+1)]) !!}
                    {!! $errors->first('dia'.($i+1), '<span class="help-block">:message</span>') !!}
                </div>              
            </div>          
        </div>
        @endfor
        
        {{-- creamos un input para cada hotel, tambien un input para el id del hotel --}}

        @for($i=0; $i < $data['hoteles']; $i++)
        <div class="row hotelDetails">
            <div class="form-group {{ $errors->has('hotel'.($i+1)) ? 'has-error' : '' }}">
                <div class="col-md-3 col-xs-4">
                    
                        {!! Form::label('hotel'.($i+1), 'Hotel '.($i+1), array('class' => 'control-label')) !!}
                
                </div>
                <div class="col-md-3 col-xs-6">
                    {!! Form::text('hotel'.($i+1), null,
                     [ 'class' => 'form-control  admin-form',
                       'id' => 'hotel'.($i+1) ]) !!}
                    {!! $errors->first('hotel'.($i+1), '<span class="help-block">:message</span>') !!}
                </div>
                <div class="col-md-1 col-xs-2">
                    <button class="btn btn-primary showModal" data-toggle="modal" data-target="#hotelModal"
                            data-position="{{ ($i+1) }}">
                                <span class="fa fa-search"></span>
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group {{ $errors->has('idhotel'.($i+1)) ? 'has-error' : '' }}">
                <div class="col-md-3 col-xs-4">
                    {!! Form::label('idhotel'.($i+1), 'Id hotel '.($i+1), 
                        array('class' => 'control-label')) !!}
                    
                </div>
                <div class="col-md-3 col-xs-8">
                    {!! Form::text('idhotel'.($i+1),null,
                     [ 'class' => 'form-control  admin-form',
                       'id' => 'idhotel'.($i+1) ]) !!}
                    {!! $errors->first('idhotel'.($i+1), '<span class="help-block">:message</span>') !!}
                </div>  
            </div>
        </div>
        @endfor
        <div class="row">
            <div class="form-group {{ $errors->has('pdfa') ? 'has-error' : '' }}">
                <div class="col-md-3 col-xs-12">
                    <p class="roboto dark-blue">
                        {!! Form::label('pdfa', 'Presentacion PDF', array('class' => 'control-label')) !!}
                    </p>
                </div>
                <div class="col-md-6 col-xs-12">
                    {!! Form::file('pdfa',  [ 'class' => 'form-control  admin-form','id' => 'pdfa' ] ) !!}
                    {!! $errors->first('pdfa', '<span class="help-block">:message</span>') !!}
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
            <div class="form-group {{ $errors->has('precio') ? 'has-error' : '' }}">
                <div class="col-md-3 col-xs-8">                    
                        {!! Form::label('precio', 'Precio agencias', array('class' => 'control-label')) !!}            
                </div>
                <div class="col-md-3 col-xs-4">
                    {!! Form::text('precio', old('precio'),
                     [ 'class' => 'form-control  admin-form']) !!}
                    {!! $errors->first('precio', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group {{ $errors->has('preciopublico') ? 'has-error' : '' }}">
                <div class="col-md-3 col-xs-8">                
                        {!! Form::label('preciopublico', 'Precio publico', 
                        array('class' => 'control-label')) !!}                    
                </div>
                <div class="col-md-3 col-xs-4">
                    {!! Form::text('preciopublico', old('preciopublico'),
                     [ 'class' => 'form-control  admin-form']) !!}
                    {!! $errors->first('preciopublico', '<span class="help-block">:message</span>') !!}
                </div>  
            </div>
        </div>

        <div class="form-group text-center">
            <p>{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}</p>
        </div>
        
        {!! Form::close() !!}
    </div>
    @include('admin.tours._hotel_modal')
@stop
@section('customjs')

<script src="http://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
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
|----------------------------------------------------------|
|                 validacion formulario                    |
|----------------------------------------------------------|
*/
$(document).ready(function(){


    var d = $('#dias').val();
    var h = $('#hoteles').val();

    $('#stepTwoForm').validate({
        rules:{
            precio: "required|numeric",
            preciopublico: "required",
            pdfa: "required",
            foto: "required"
        }
    });

    for (var i = 1; i < parseInt(d) + 1; i++) {
        $('#dia'+i).rules('add',{ required: true });
    }
});
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
    $('#hotel'+position).val(name);
    $('#idhotel'+position).val(id);
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