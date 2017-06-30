@extends('master')
@section('title','Busqueda de hoteles en Andalucia | Hoteles en la costas andaluzas')
@section('meta_description','Andalusiandoviaggi vende tours y reservas de hoteles a agencias 
y particulares. Los mejores precios para hacer tours de Andalucia.')
@section('hotel','class="active"')
@section('customcss')
    <link rel="stylesheet" href="{{ asset('datepicker/css/datepicker.css') }}">
@stop
@section('content')
<section class="search-form-container">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 login">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="lato-300 text-center">
                            Encuentra ofertas en hoteles para todas las temporadas
                        </h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['url' => '/hotel/search',null,'class' => 'form-horizontal',
                                        'id' => 'search_form']) !!}
                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <div class="form-group{{ $errors->has('destino') ? ' has-error' : '' }}">
                                	<div class="col-md-4 control-label">
                                		{!! Form::label('destino','Destino') !!}
                                	</div>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <span class="fa fa-map-marker"></span>
                                            </div> 
                                            	{!! Form::select('destino',
                                                                  $destinos,
                                                                  null, 
                                                                  ['class' => 'form-control',
                                                                      'id' =>'destino',
                                                                      'onchange' => 'setZones()']) 
                                                !!} 
                                        </div>
                                        @if ($errors->has('destino'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('destino') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <div class="form-group{{ $errors->has('zona') ? ' has-error' : '' }}" >
                                	<div class="col-md-4 control-label">
                                	    {!! Form::label('zona','Zona') !!}
                                	</div>
                                    <div class="col-md-8">
                                         <div class="input-group">
                                            <div class="input-group-addon">
                                                <span class="fa fa-map-marker"></span>
                                            </div> 
                                        	{!! Form::select('zona',
                                                             ['Todas las zonas'],
                                                             null, 
                                                             ['class' => 'form-control','id' => 'zona'])
                                            !!} 
                                        </div>
                                        @if ($errors->has('zona'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('zona') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>                          
                            </div>
                        </div>
                        <div class="row">
                            <!-- right side -->
                            <div class="col-md-6 col-xs-6">
                                <div class="form-group{{ $errors->has('entrada') ? ' has-error' : '' }}">
                                    <div class="col-md-4 control-label">
                                        {!! Form::label('entrada','Entrada') !!}
                                    </div>                                
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </div> 
                                            {!! Form::input('text','entrada',null,
                                                           ['class' => 'form-control',
                                                            'id' => 'entrada',
                                                            'readonly']) !!}                                
                                        </div>
                                        @if ($errors->has('entrada'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('entrada') }}</strong>
                                            </span>
                                        @endif                                    
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <div class="form-group{{ $errors->has('salida') ? ' has-error' : '' }}">
                                    <div class="col-md-4 control-label">
                                        {!! Form::label('salida','Salida') !!}
                                    </div>

                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </div> 
                                            {!! Form::input('text','salida',null,
                                                           ['class' => 'form-control', 
                                                            'id' => 'salida',
                                                            'readonly']) !!}
                                        </div>
                                        @if ($errors->has('salida'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('salida') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>   
                            @include('hotel._add_room',['roomNr' => 1])
                            @include('hotel._add_room',['roomNr' => 2])
                            @include('hotel._add_room',['roomNr' => 3])
                            @include('hotel._add_room',['roomNr' => 4])
                            @include('hotel._add_room',['roomNr' => 5])
                           
                            {!! Form::hidden('roomsNumber',1,['id' => 'roomsNumber']) !!}
                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fa fa-btn fa-search"></i>Busca
                                    </button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div><!-- fin panel-body -->
                </div><!-- fin panel panel-default-->
            </div><!-- fin login -->
        </div><!-- fin row -->
    </div><!-- fin container -->
</section><!-- fin section -->
@endsection

@section('customjs')
<script src="{{ asset('datepicker/js/bootstrap-datepicker.js') }}"></script>    
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="{{ asset('datepicker/js/locales/bootstrap-datepicker.es.js') }}"></script>


<script type="text/javascript">
    //objeto que contiene todas las zonas de la base de datos
    var z = new Object();
        @foreach ($idZonas as $id)
            {!! 
                'z['. $id->IdZona .'] = { nombreZona: "' . $id->NombreZona . 
                                          '", idZona: ' . $id->IdZona .
                                          ', idDestino: ' . $id->IdDestino . '};'                                 
            !!}
        @endforeach
    
    /*|-------------------------------------------|
      |            MANIPULAR ZONAS                |
      |-------------------------------------------|*/

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
                    text: z[id].nombreZona
                }));
            }             
        }
    };
    setZones();

    /*|----------------------------------------------|
      |           AÑADIR/BORRAR HABITACIONES         |
      | @param id, id de la habitacion               |
      |----------------------------------------------|
    */

    $(".addRoom").click(function(event){
        event.preventDefault();
    }); 
    var lastId = $('#roomsNumber').val();

    function setRooms(id){
        
        var roomId = '#div_for_room_'+ id;
        var nextRoomId = '#div_for_room_' + (id + 1);
        var roomButton = $(roomId).find('button');
        var spanFa = roomButton.find('span');

        // la habitacion siquiente no esta visible
        if ($(nextRoomId).css('display') == 'none'){                
             $(nextRoomId).show(400);
             // cambio el icono del boton de "+" a "-"
             $(roomId).find('button')
                .attr('class','btn btn-warning addRoom pull-right')
                .find('span')
                .attr('class','fa fa-minus-circle');
            // id ultima habitacion visible
             lastId = id + 1;
        } else {
            var roomToHide = $('#div_for_room_' + lastId);
            if (lastId > 1) {
                roomToHide.hide(400);
                $('#adult_in_room_' + lastId).val(1);
                $('#child_in_room_' + lastId).val(0);
                setChildrenAge(lastId);
            }
            // cambio el icono del boton de "-" en "+"
            $('#div_for_room_' + (lastId - 1)).find('button')
             .attr('class','btn btn-success addRoom pull-right')
             .find('span')
             .attr('class','fa fa-plus-circle');
            $(roomButton).show();
            lastId -= 1;
        }
        // actualizo el roomsNumber
        $('#roomsNumber').val(lastId);
    }

    /*|-------------------------------|
      |        EDAD NIÑOS             |
      |@param roomId, id habitacion   |
      |-------------------------------|*/

    function setChildrenAge(roomId){
        // niños en habitacion
        var c = $('#child_in_room_' + roomId).val();
        // la etiqueta "Edad niños" no es visible si no hay niños en la habitacion
        if (c > 0){
            $('#ages_for_room_' + roomId).show();
        } else {
            $('#ages_for_room_' + roomId).css('display','none');
        }             

        for (var i = 0; i < 3; i++) {
            var closestDiv = $('#room_'+roomId+'_age_' + i).closest('.child_'+ i);
            if ( i >= c){
                closestDiv.hide(500);
                $('#room_'+roomId+'_age_' + i).val(0);

                //$('#room_'+roomId+'_age_' + i).rules("remove");

            } else {
                if (closestDiv.css('display') == 'none') {                    
                    
                    closestDiv.show(500);
                    
                }                    
            }
            
            
        }
        if (c == 0) {
            $('#div_for_room_'+roomId).find('button').removeClass('addRoomXs');
        } else {
             $('#div_for_room_'+roomId).find('button').addClass('addRoomXs');
        }
    }

    $(document).ready(function(){
        var roomsNumber = $('#roomsNumber').val();
        for (var i = 1; i <= roomsNumber; i++) {
            setChildrenAge(i);
            if ($("#div_for_room_"+i).css('display') == 'none') {
                $('#div_for_room_'+i).show();
            }
            if (i != roomsNumber) {
                $('#div_for_room_'+ i).find('button')
                    .attr('class','btn btn-warning addRoom pull-right')
                    .find('span')
                    .attr('class','fa fa-minus-circle');
            }
            $('#div_for_room_' + i).find('button').addClass('addRoomXs');
        }
    });

/*
|-----------------------------------------------------------|
|              DATE PICKER                                  |
|-----------------------------------------------------------|
*/ 
    
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    // datepicker entrada
    var checkin = $('#entrada').datepicker({
        format: 'yyyy-mm-dd',
        weekStart: 1,
        language: 'es',
        startDate: now
    }).on('changeDate', function(ev) {
        
        var newDate = new Date(checkin.getDate());
        // la fecha de salida tiene que ser por lo menos un 
        // dia despues de la fecha de entrada
        newDate.setDate(newDate.getDate() + 1);
        checkout.setDate(newDate);                     
        checkout.setStartDate(new Date(checkin.getDate()));
        
        checkin.hide(); 
        $('#salida')[0].focus();
    }).on('show', function(event){
        // el datepicker tiene por defecto un margin-left de 169px, hay que coregir en 
        // pantalla pequeñas
        
        var w = $(window).width();                   // ancho ventana
        var o = $('.datepicker').offset().left;      // position con respecto a la ventana 
        if (w < 800) {
            var m = $('.datepicker').width();        // ancho datepicker            
            var l = ((w - m) / 2) + 164;             // margin-left coregido
            // si el datepicker se abre fuera de la ventana
            if (o < 0) {
                $('.datepicker').css('margin-left',l + 'px');
            }                    
        }                   
       
    }).data('datepicker');
    
    // datepicker salida
    var checkout = $('#salida').datepicker({
        format: 'yyyy-mm-dd',
        weekStart: 1,
        language: 'es'
    }).on('changeDate', function(ev) {
        checkout.hide();
    }).data('datepicker');

/*
|---------------------------------------------------------|
|          VALIDACION FORMULARIO                          |
|---------------------------------------------------------|
*/

$(document).ready(function(){    
    
    $('#search_form').validate({
        rules: {
            entrada:{
                required:true,
                minlength:5
            },
            salida:{
                required:true,
                minlength: 5
            },
            room_1_age_0:{
                required: true,
                min: 1
            },
            room_1_age_1:{
                required: true,
                min: 1
            },
            room_2_age_0:{
                required: true,
                min: 1
            },
            room_2_age_1:{
                required: true,
                min: 1
            },
            room_3_age_0:{
                required: true,
                min: 1
            },
            room_3_age_1:{
                required: true,
                min: 1
            },
            room_4_age_0:{
                required: true,
                min: 1
            },
            room_4_age_1:{
                required: true,
                min: 1
            },
            room_5_age_0:{
                required: true,
                min: 1
            },
            room_5_age_1:{
                required: true,
                min: 1
            }
        },
        messages:{
            entrada: {
                required: "Fecha de entrada obligatoria!",
                minlength: "Fecha de entrada malformada!"
            },
            salida: {
                required: "Fecha de salida obligatoria!",
                minlength: "Fecha de salida malformada!"
            },
            room_1_age_0:{
                required: "",
                min: ""
            },
            room_1_age_1:{
                required: "",
                min: ""
            },
            room_2_age_0:{
                required: "",
                min: ""
            },
            room_2_age_1:{
                required: "",
                min: ""
            },
            room_3_age_0:{
                required: "",
                min: ""
            },
            room_3_age_1:{
                required: "",
                min: ""
            },
            room_4_age_0:{
                required: "",
                min: ""
            },
            room_4_age_1:{
                required: "",
                min: ""
            },
            room_5_age_0:{
                required: "",
                min: ""
            },
            room_5_age_1:{
                required: "",
                min: ""
            }
        },
        highlight: function(element, errorClass,validClass){
            $(element).parents('div.form-group').addClass('has-error');
        },
        unhighlight: function(element, errorClass){
            $(element).parents('div.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var a = "";
            if (element.closest('.col-md-9').length > 0) {
                a = element.closest('.col-md-9');
            } else {
                a = element.closest('.col-md-8');
            }
            error.appendTo(a);
            console.log(element.attr('name'));
        }
    });
});


</script>
@stop