@extends('admin_master')
@section('title','Administracion de destinos turisticos | Andalusiando Viaggi')
@section('destinos','class="active"')
@section('content')
    <div class="container table-responsive">
        <div class="row">
        	<div class="col-md-12 col-xs-12 login">
                <p><a href="{{ url('admin/destinos') }}"><i class="fa fa-arrow-left"></i>Volver</a></p>
        		<h1 class="lato-300 blue text-center">Estas viendo las zonas de {{ $destino->NombreDestino }}</h1>
    			<table class="table table-striped">
    				<tr>
    					<td></td>
    					<td><h4 class="lato-300 dark-blue">Zona</h4></td>
    					<td><h4 class="lato-300 dark-blue">Id zona</h4></td>    					
                        <td><h4 class="lato-300 dark-blue">Activado</h4></td>
                        <td><h4 class="lato-300 dark-blue">Hoteles</h4></td>
        			@foreach ($allZones->getNodes('ZONE',null) as $z)
        			    <tr>
        			    	<td></td>
	                        <td><p class="roboto">{{ $z['name'] }}</p></td>
	                        <td><p class="roboto">{{ $z['id'] }}</p></td>	                        
                            <td>
                                @if ($zonas->contains('IdZona',$z['id']))
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox switchButton"
                                         id="switch{{$z['id'] }}" data-state="on"
                                         data-id="{{$z['id'] }}" data-name="{{ $z['name'] }}" checked>

                                        <label class="onoffswitch-label" for="switch{{$z['id'] }}"></label>
                                    </div>
                                    
                                @else
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox switchButton"
                                         id="switch{{$z['id'] }}" data-state="off"
                                         data-id="{{$z['id'] }}" data-name="{{ $z['name'] }}">
                                         
                                        <label class="onoffswitch-label" for="switch{{ $z['id'] }}"></label>
                                    </div>
                                @endif
                            </td>
                            <td>                                
                                <button class="btn btn-success searchHotel"  data-toggle="modal" data-target="#hotelModal"
                                 data-zone="{{$z['id']}}" data-name="{{$z['name']}}">
                                 Ver hoteles</button>                           
                            </td>
	                    </tr>
	                @endforeach
	            </table>			
        		<p><a href="{{ url('admin/destinos') }}"><i class="fa fa-arrow-left"></i>Volver</a></p>
    		</div>
        </div>        
    </div>
  	
  	<div id="hotelModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="lato-300 blue text-center" id="zoneName"></h2>
                </div>
                <div class="modal-body">
                   
                </div>                    
            
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal" >
                        <span class="fa fa-close"></span>Cerrar</button>
                </div>
            </div>
        </div>
    </div>

@stop

@section('customjs')
<script type="text/javascript">
/*
|------------------------------------------------------|
|       Modal busqueda hoteles en una zona             |
|------------------------------------------------------|
*/
$('.searchHotel').click(function(event) {
   event.preventDefault();
});

// boton que lanza el modal con los hoteles de la zona
$('.searchHotel').on('click',function(e){
    
	var zoneId = $(this).data('zone');         // id zona
    var zoneName = $(this).data('name');       // nombre zona
    var modalBody =  $('#hotelModal').find('.modal-body');  // cuerpo modal
    
    $.ajax({
        url: "{{ url('ver/hoteles/'.$destino->IdDestino) }}" + "/" + zoneId + "/ver", 
        type: "GET",
        dataType: 'html',
        cache: false,   
        success: function(data) {
            // limpiamos la tabla con los resultados
            $('#resultTable').remove();
            var html_data = data;
            
            // injectamos la tabla devuelta del controlador
            modalBody.append(html_data);
            // nombre zona en el titulo del modal
            $('#zoneName').text('Hoteles en ' + zoneName);                   
        },
        error: function(data){
            $('#errorText').text("Error! No se puede mostrar ningun hotel");
        }
    });
    
    // lanzamos el modal
    $('#hotelModal').show();
});
$('#hotelModal').on('hide.bs.modal', function(event){
    $('#resultTable').remove();
})
/*
|------------------------------------------------------------|
|                 SWITCH ZONAS                               |
|------------------------------------------------------------|
*/
$('.switchButton').on('click', function(){
    var button = $(this);
    var zoneId = $(this).data('id');
    var zoneName = $(this).data('name'); 
    
    
    if( button.data('state') === 'off') {
        // activa la zona en la base de datos
        $.ajax({
            url: "{{ url('admin/zonas/nueva/'.$destino->IdDestino) }}" + "/" + zoneId + "/" + zoneName, 
            type: "GET",
            dataType: 'html',
            cache: false,   
            success: function(data) {
                button.data('state','on');                        
            },
            error: function(data){
                alert('No se puede añadir la zona!');
            }
        });
    } else {
        // la zona esta activa, la desactivamos
        $.ajax({
            url: "{{ url('admin/zonas/borrar') }}" + "/" + zoneId, 
            type: "GET",
            dataType: 'html',
            cache: false,   
            success: function(data) {
                button.data('state','off');                                         
            },
            error: function(data){
                alert('No se puede borrar la zona!');
            }
        });
    }
});
</script>
@stop