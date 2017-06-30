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
    					<td><h4 class="lato-300 dark-blue">Destino</h4></td>
    					<td><h4 class="lato-300 dark-blue">Id destino</h4></td>
    					<td><h4 class="lato-300 dark-blue">Zonas</h4></td>
    				</tr>
        			@foreach ($destinos as $destino)
        			    <tr>
	                        <td>
	                        	<p class="roboto">{{ $destino->NombreDestino }}</p>
	                        </td>
	                        <td>
	                        	<p class="roboto">{{ $destino->IdDestino }}</p>
	                        </td>
	                        <td>
	                        	<a href="{{ url('/admin/destino/'.$destino->IdDestino.'/zonas') }}">
	                        		<button class="btn btn-success">Ver zonas</button>
	                        	</a>
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
                    <h2 class="lato-300 danger text-center">Eliminar tour</h2>
                </div>
                <div class="modal-body">
		            <h3 class="lato-300" id="message">Estas seguro que quieres borrar el tour</h3>
		            <h4 class="lato-300 orange">Recurede que esta accion no es reversible.</h4>
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
   
</script>
@stop