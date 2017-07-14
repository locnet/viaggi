@extends('admin_master')
@section('title','Home Page')
@section('all','class="active"')
@section('content')
    <div class="container-fluid">
        <div class="row">
        	<div class="col-md-12 col-xs-12 login table-responsive">
    			<table class="table table-striped">
    				<tr>
    					<td></td>
    					<td><h4 class="lato-300 dark-blue">Titulo</h4></td>
    					<td class="hidden-xs"><h4 class="lato-300 dark-blue">Fecha creacion</h4></td>
    					<td><h4 class="lato-300 dark-blue">Editar</h4></td>
    					<td><h4 class="lato-300 dark-blue">Borar</h4></td>
    				</tr>
        			@foreach ($ofertas as $oferta)
        			    <tr>
	        			    <td>
	                            <a href="{{ url('/admin/ofertas/editar',$oferta->id) }}">
	                                <img alt="{{ ucfirst($oferta->titulo) }}"
	                                    src="{{ asset('admin/images')."/".$oferta->foto }}"
	                                    width="60" height="40" /> 
	                            </a>
	                        </td>
	                        <td>
	                        	<p class="roboto">{{ $oferta->titulo }}</p>
	                        </td>
	                        <td class="hidden-xs">
	                        	<p class="roboto">{{ $oferta->created_at }}</p>
	                        </td>
	                        
	                        <td>
	                        	<a href="{{ url('/admin/ofertas/editar/'.$oferta->id) }}">
	                        		<button class="btn btn-success">Editar</button>
	                        	</a>
	                        </td>
	                        <td>
	                        	
	                           <button class="btn btn-warning" data-toggle="modal" data-target="#deleteModal"
	                           	data-id="{{$oferta->id}}" data-titulo="{{$oferta->titulo}}">Borrar</button>
	                        	
	                        </td>
	                    </tr>
	                @endforeach
	                </table>        			
        		</div>
    		</div>
        </div>        
    </div>
  
    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="lato-300 danger text-center">Eliminar oferta</h2>
                </div>
                <div class="modal-body">
		            <h3 class="lato-300" id="message">¿Estas seguro que quieres borrar la oferta: </h3>
		            <h4 class="lato-300 orange text-center">Esta accion no es reversible.</h4>
		    </div>
		    <div class="modal-footer">
			    <button type="button" class="btn btn-danger" data-dismiss="modal"  id="deleteButton">
			    	<span class="fa fa-edit"></span>Borrar</button>
			    <button type="button" data-dismiss="modal" class="btn btn-success" id="cancel">
			    	<span class="fa fa-close"></span>Cancelar</button>
		    </div>
		</div>
	</div>
	
	

@stop

@section('customjs')
<script type="text/javascript">
    $("#deleteModal").on('show.bs.modal', function(event) {
    	var button = $(event.relatedTarget);                           // el boton que lanza el modal
    	var message = $('#message');
        var newMessage = message.text() + '"{{ $oferta->titulo }} ?"';   // mensaje + nombre tour
        message.text(newMessage);
        $('#deleteButton').on('click',function(){
            window.location = "{{ url('/admin/ofertas/borrar') }}" + "/" + button.data('id');
        })     
        
    });
</script>
@stop