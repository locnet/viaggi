@extends('admin_master')
@section('title','Andalusiando Viaggi administracion | Editar tour')
@section('edit','class="active"')
@section('customcss')
    <link rel="stylesheet" href="{{ asset('datepicker/css/datepicker.css') }}">
@stop
@section('content')
    
        <div class="page-header">
            <h1 class="text-center lato-300">Editar tour {{ $tour->titulo }}</h1>
        </div>
            {!! Form::open(['url' => '/admin/tours/update/'.$tour->id, 'files' => true]) !!} 
        <div class="row">
	        <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
	        	<div class="col-md-3 control-label">
	        		<p class="roboto dark-grey">
	        		    {!! Form::label('titulo', 'Titulo tour:', array('class' => 'control-label')) !!}
	        		</p>
	        	</div>
	        	<div class="col-md-9 col-xs-12">
	        		{!! Form::text('titulo', $tour->titulo !=null ? $tour->titulo : null,
	        		          [ 'class' => 'form-control admin-form']) !!}
	        		{!! $errors->first('titulo', '<span class="help-block">:message</span>') !!}
	        	</div>	        	
		    </div>
		</div>
	    <div class="row">
		    <div class="form-group{{ $errors->has('destino') ? ' has-error' : '' }}">
		    	<div class="col-md-3 control-label">
		    	    <p class="roboto dark-blue">
		    	    	{!! Form::label('destino', 'Destino: ', array('class' => 'control-label')) !!}
		    	    </p>
		    	</div>
		    	<div class="col-md-3 col-xs-12">
		    		{!! Form::select('destino', $destinos, $tour->destino != null ? $tour->destino : null,
		    		    ['class' => 'form-control  admin-form', 'id' => 'destiny']) !!}
		    		{!! $errors->first('destino', '<span class="help-block">:message</span>') !!}
		    	</div>		    	
		    </div>
		</div>
		<div class="row">
		     <div class="form-group{{ $errors->has('visibility') ? ' has-error' : '' }}">
		     	<div class="col-md-3 col-xs-9 control-label">
		     		<p class="roboto dark-blue">
		     		    {!! Form::label('visibility', 'Visibile en portada:', array('class' => 'control-label')) !!}
		     	    </p>
		     	</div>
		     	<div class="col-md-9 col-xs-3">
		    	    {!! Form::checkbox('visibility', old('visibility'), ['class' => 'form-control pull-right']) !!}
		    	</div>
		    </div>
		</div>
		<div class="row">
		    <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
		        <div class="col-md-3 col-xs-12 control-label">
		        	<p class="roboto dark-blue">
		        	    {!! Form::label('descripcion', 'Descripcion:', array('class' => 'control-label')) !!}
		        	</p>
		        </div>
		        <div class="col-md-9 col-xs-12">
		    	    <p> {!! Form::textarea('descripcion', $tour->descripcion =! null ? $tour->descripcion : null,
		    	         ['class' => 'form-control  admin-form']) !!} </p>
		    	</div>
		    </div>
		</div>
		<div class="row">
		     <div class="form-group {{ $errors->has('start') ? 'has-error' : '' }}">
		     	<div class="col-md-3 col-xs-6">
	        	    <p class="roboto dark-blue">
	        	    	{!! Form::label('start', 'Fecha inicio:', array('class' => 'control-label')) !!}
	        	    </p>
	        	</div>
	        	<div class="col-md-3 col-xs-6 date">
	        	    {!! Form::input('text', 'start', $tour->start != null ? $tour->start : null,
	        	     [ 'class' => 'form-control  admin-form',
	        	       'id' => 'start',
	        	       'readonly']) !!}
	        	    {!! $errors->first('start', '<span class="help-block">:message</span>') !!}
	        	</div>
	        </div>
	    </div>
	    <div class="row">
	    	<div class="form-group {{ $errors->has('fin') ? 'has-error' : '' }}">
	        	<div class="col-md-3 col-xs-6">
	        		<p class="roboto dark-blue">
	        			{!! Form::label('fin', 'Fecha fin:', array('class' => 'control-label')) !!}
	        		</p>
	        	</div>
	        	<div class="col-md-3 col-xs-6">
	        		{!! Form::input('text', 'fin', $tour->fin != null ? $tour->fin : null,
	        		 [ 'class' => 'form-control  admin-form',
	        		   'id' => 'fin', 'readonly']) !!}
	        		{!! $errors->first('fin', '<span class="help-block">:message</span>') !!}
	        	</div>	        	
		    </div>
		</div>
		
		<?php $dias = explode('&',$tour->dias);?>

        {{-- necesito el numero total de dias para validar el formulario --}}
        {!! Form::hidden('dias',count($dias) ) !!}

		@for($i=0; $i < count($dias); $i++)
        <div class="row">
	    	<div class="form-group {{ $errors->has('dia'.($i+1)) ? 'has-error' : '' }}">
	        	<div class="col-md-3 col-xs-12">
	        		<p class="roboto dark-blue">
	        			{!! Form::label('dia'.($i+1), 'Dia '.($i+1), array('class' => 'control-label')) !!}
	        		</p>
	        	</div>
	        	<div class="col-md-9 col-xs-12">
	        		{!! Form::textarea('dia'.($i+1), $dias[$i] != null ? $dias[$i] : null, [ 'class' => 'form-control  admin-form']) !!}
	        		{!! $errors->first('dia'.($i+1), '<span class="help-block">:message</span>') !!}
	        	</div>	        	
		    </div>		    
		</div>
		@endfor
		
		<?php $hoteles = explode('&',$tour->hoteles); $idhotel = explode('&',$tour->idhoteles); ?>

        {{-- necesito el numero total de hoteles  para validar el formulario --}}
        {!! Form::hidden('hoteles',count($hoteles) ) !!}

		@for($i=0; $i < count($hoteles); $i++)
		<div class="row">
	    	<div class="form-group {{ $errors->has('hotel'.($i+1)) ? 'has-error' : '' }}">
	        	<div class="col-md-3 col-xs-4">
	        		
	        			{!! Form::label('hotel'.($i+1), 'Hotel '.($i+1), array('class' => 'control-label')) !!}
	        	
	        	</div>
	        	<div class="col-md-3 col-xs-6">
	        		{!! Form::text('hotel'.($i+1), $hoteles[$i] != null ? $hoteles[$i] : null,
	        		 [ 'class' => 'form-control  admin-form']) !!}
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
	        		{!! Form::text('idhotel'.($i+1), $idhotel[$i] != null ? $idhotel[$i] : null,
	        		 [ 'class' => 'form-control  admin-form']) !!}
	        		{!! $errors->first('idhotel'.($i+1), '<span class="help-block">:message</span>') !!}
	        	</div> 	
		    </div>
		</div>
		@endfor
		<div class="row">
			<div class="form-group">
				<div class="col-md-3 col-xs-12">
					<p class="roboto dark-blue">
						{!! Form::label('pdfa', 'Presentacion PDF', array('class' => 'control-label')) !!}
					</p>
				</div>
				<div class="col-md-6 col-xs-12">
					{!! Form::file('pdfa',  [ 'class' => 'form-control  admin-form' ] ) !!}
	        	</div>
	        </div>
	    </div>
		<div class="row">
			<div class="form-group">
				<div class="col-md-3 col-xs-12">
					
						{!! Form::label('foto', 'Imagen', array('class' => 'control-label')) !!}
					
				</div>
				<div class="col-md-6 col-xs-12">
					{!! Form::file('foto',  [ 'class' => 'form-control  admin-form']) !!}
	        	</div>
	        </div>
	    </div>

	    <div class="row">
	    	<div class="form-group {{ $errors->has('precio') ? 'has-error' : '' }}">
	        	<div class="col-md-3 col-xs-8">
	        		
	        			{!! Form::label('precio', 'Precio agencias', array('class' => 'control-label')) !!}
	        
	        	</div>
	        	<div class="col-md-3 col-xs-4">
	        		{!! Form::text('precio', $tour->precio != null ? $tour->precio : null,
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
	        		{!! Form::text('preciopublico', $tour->preciopublico != null ? $tour->preciopublico : null,
	        		 [ 'class' => 'form-control  admin-form']) !!}
	        		{!! $errors->first('preciopublico', '<span class="help-block">:message</span>') !!}
	        	</div> 	
		    </div>
		</div>
		<div class="col-md-12 text-center form-group">
            <p>{!! Form::submit('Acceptar', ['class' => 'btn btn-primary']) !!}</p>
        </div>
        
        {!! Form::close() !!}
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
            success: function(data){console.log(data.length)
                // remove old data
                $('#resultTable').remove();
                var html_data = data;
                modal.find('.modal-body').append(data);
                
            },
            error: function(data){
                $('#errorText').text("Error! No se puede mostrar ningun hotel");
            }
        });
    })     
    
});

$("#hotelModal").on('hide.bs.modal', function(event) {
  
    // borramos la tabla con los resultados
    $('#resultTable').remove();

});

/**
* inserta los datos del hotel seleccionado en el modal en el input corespondiente
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
                    text: z[id].nombreZona
                }));
            }             
        }
    };
    setZones();

</script>
@stop