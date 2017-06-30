@extends('admin_master')
@section('title','Home Page')
@section('destinos','class="active"')
@section('content')
    <div class="container-fluid">
        <div class="row">
        	<div class="col-md-12 col-xs-12 login">
        		<h1 class="lato-300 blue text-center">Destinos Andalusiandoviaggi</h1>
    			<table class="table table-striped">
    				<tr>
    					<td><h4 class="lato-300 dark-blue">Id Destino</h4></td>
    					<td><h4 class="lato-300 dark-blue">Destino</h4></td>
    					<td><h4 class="lato-300 dark-blue">Activado/No activado</h4></td>
    				</tr>
        			@foreach ($destSide->getNodes('DESTINATION',null) as $destino)
        			    <tr>
	                        <td>
	                        	<p class="roboto">{{ $destino['id'] }}</p>
	                        </td>
	                        <td>
	                        	<p class="roboto">{{ $destino['name'] }}</p>
	                        </td>
	                       
	                        <td>
                        	@if ($destViaggi->contains('IdDestino',$destino['id']))
                                <div class="onoffswitch">
                                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox switchButton"
                                     id="switch{{$destino['id'] }}" data-state="on"
                                     data-id="{{$destino['id'] }}" data-name="{{ $destino['name'] }}" checked>

                                    <label class="onoffswitch-label" for="switch{{$destino['id'] }}"></label>
                                </div>
                        	    
                        	@else
                        	    <div class="onoffswitch">
                                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox switchButton"
                                     id="switch{{$destino['id'] }}" data-state="off"
                                     data-id="{{$destino['id'] }}" data-name="{{ $destino['name'] }}">
                                     
                                    <label class="onoffswitch-label" for="switch{{$destino['id'] }}"></label>
                                </div>
                        	@endif                        
	                        </td>
	                    </tr>
	                @endforeach
	                </table>        			
        		</div>
    		</div>
        </div>        
    </div>	
	

@stop

@section('customjs')
<script type="text/javascript">
   // listener button
   $('.switchButton').on('click',function() {
    var button = $(this);                      // buton
   	var id = button.data('id');                // id destino
    var statusSpan = $('#'+id);                // nombre destino

   	if ( button.data('state') === 'off') {
   		var name = button.data('name');
   		$.ajax({
            url: "{{ url('admin/destinos/nuevo') }}" + "/" + id + "/" + name,
            type: "GET",
            dataType: 'html',            
            success: function(data){
                button.data('state','on');
                button.removeClass('btn-success');
                button.addClass('btn-warning');
                statusSpan.removeClass('fa-times fa-red');
                statusSpan.addClass('fa-check fa-green');
            },
            error: function(data){
                alert("No hemos podido añadir el destino");
            }
        });
   	} else {
        $.ajax({
            url: "{{ url('admin/destinos/borrar') }}" + "/" + id,
            type: "GET",
            dataType: 'html',            
            success: function(data){
                button.data('state','off');
                button.removeClass('btn-warning');
                button.addClass('btn-success');
                statusSpan.addClass('fa-times fa-red');
                statusSpan.removeClass('fa-check fa-green');
                
            },
            error: function(data){
                alert("No hemos podido borrar el destino");
            }
        });
   	}
   })
</script>
@stop