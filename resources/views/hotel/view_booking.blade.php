@extends('master')
@section('title','Ofrecemos hoteles baratos | Habitaciones baratas en la playa')
@section('meta_description','Andalusiandoviaggi ofrece los mejores precios en habitaciones de
hotel en la playa.')
@section('hotel','class="active"')
@section('customcss')    
@stop

@section('content')
<div class="container">
	<div class="row">
	    <div class="col-md-offset-1 col-md-10">		
				<h1 class="lato-300 text-center blue">¡GRACIAS!</h1>
				<h3 class="lato-300 text-center dark-grey">Te agradecemos tu confianza en los 
					servicios de Andalusiando Viaggi. A continuacion tienes todos los detalles de tu reserva.
				</h3>		
		    <?php 
		        foreach ($hotel->getNodes("BUILDING", false) as $h) {
		            $dir = $h['address'];
		            $postcode = $h['postcode'];
		            $tel = $h['telephone1'];
		            $email = $h['email'];
		            $buildingType = $h['building_type_name'];
		        }
		    ?>
		    @foreach($booking->getNodes("RESERVATION",false) as $b)
		    <div class="col-md-12 col-xs-12"> 
		        <h3 class="lato-300 blue">Detalles estancia</h3>	
		    	<table class="table table-striped table-responsive">		    
				    <tr>
				    	<td><h4 class="lato-300">
				    		<i class="fa fa-h-square"></i>Alojamiento:</h4>
				    	</td>
				    	<td>
				    		<h3 class="lato-300 blue">{{ $buildingType ." " .$b['building_name'] }}</h3>
				    					    	
		                    <h4 class="lato-300 dark-grey">{{ $dir }}</h4>
		                    <p class="lato-300 dark-grey">
		                    	{{ $b['zone_name'] }}, {{ $postcode .' - '. $b['destination_name'] }}
		                    </p>
				    		<p class="lato-300 dark-grey">Telefono: {{ $tel }}</p>
				    		<p class="lato-300 dark-grey">{{ $email }}</p>
				    	</td>
				    </tr>		   
				    <tr>
				    	<td><h4 class="lato-300"><i class="fa fa-hotel"></i>Acomodacion:</h4></td>
				    	<td>
				    		<h4 class="lato-300 dark-grey">{{ $b->ROOM['aco_name'] }}</h4>
			    			<p class="lato-300 dark-grey">
					    		@if ($b['num_nights'] > 1)
					    		    {{ $b['num_nights'] }} noches,
			                    @else 
			                        {{ $b['num_nights'] }} noche,
			                    @endif
			                    @if ($b['num_rooms'] > 1)
			                        {{ $b['num_rooms'] }} habitaciones
			                    @else
			                        {{ $b['num_rooms'] }} habitacion
			                    @endif
			                </p>
			                <p class="lato-300 dark-grey">{{ $b['board_name'] }}</p>
		                </td>
		            </tr>
		            <?php
		                // creamos un timestamp de cada fecha para manipular con Carbon
		                $in  = Carbon\Carbon::createFromFormat('d/m/Y','17/12/2017');
		                $out = Carbon\Carbon::createFromFormat('d/m/Y', $b['check_out_dmy']);
		                // hacking para poner dia y mes en español
		                $day_in = $fecha['dia'][$in->dayOfWeek] .", ". 
		                        $in->format('j') ." ".
		                        $fecha['mes'][$in->month-1] ." ".
		                        $in->format('Y');

		                $day_out = $fecha['dia'][$out->dayOfWeek] .", ". 
		                        $out->format('j') ." ".
		                        $fecha['mes'][$out->month-1] ." ".
		                        $out->format(' Y ');

		            ?>     
		            <tr>
				    	<td><h4 class="lato-300"><i class="fa fa-calendar"></i>Estancia</h4></td>
				    	<td><h4 class="lato-300 dark-grey">Entrada {{ $day_in }}, salida {{ $day_out }}</h4></td>
				    </tr>		    
						    
				    <tr>
				    	<td>
				    		<h4 class="lato-300"><i class="fa fa-male"></i>Titular:</h4>
				    	</td>
				    	<td>
				    	    <h4 class="lato-300">
				    	    	<span class="dark-grey">{{ ucfirst($b->ROOM['contact']) }}</span>
				    	    </h4>
				    	</td>
				    </tr>
				    <tr>
                        <td>
				    	    <h4 class="lato-300 "><i class="fa fa-info"></i>Localizador reserva:</h4>
				    	</td>
				    	<td>
				    		<h4 class="lato-300">
				    	    <span class="dark-grey">{{ $b['locata'] }}</span></h4>
				    	</td>
				    </tr>
				    <tr>
				    	<td>
				    	    <h4 class="lato-300"><i class="fa fa-calendar"></i>Fecha reserva:</h4>
				    	</td>
				    	<td>
				    		<h4 class="lato-300">
				    	        <span class="dark-grey">{{ $b['date_dmy'] }}</span>
				    	    </h4>
				    	</td>
				    </tr>
				    <tr>
				    	<td>
				    		<h4 class="lato-300"><i class="fa fa-remove"></i>Cancelacion:</h4>
				    	</td>
				    	<td>
				    		<h4 class="lato-300 dark-grey">
				    	       	Gratuita antes del: {{ $b->ROOM->CANCEL_POLICIES->{0}['from_dmy'] }}
				    	   </h4>
				    	 <td>				        
				    </tr>				    	
				</table>
				<h3 class="lato-300 pull-right"><i class="fa fa-cc-visa"></i>Precio pagado:
				    		<strong><span class="blue">{{ number_format($reserva->precio,2) }} €</span></strong>
	    		</h3>
			</div>
			<div class="col-md-6 col-xs-6 text-center">
				<h2><a href="{{ url('hotel/ver/pdf/'.$b['locata']) }}" class="text-center">
	                <button class="btn btn-default center" id="pdfButton" data-locata="{{ $b['locata'] }}">
	                	<i class="fa fa-file-pdf-o"></i>Ver confirmacion
	                </button>
	            </a></h2>
			</div>
			<div class="col-md-6 col-xs-6 text-center">
				<h2><a href="{{ url('hotel/descargar/pdf/'.$b['locata']) }}" class="text-center">
	                <button class="btn btn-primary">
	                	<i class="fa fa-download"></i>Ver/descargar bono
	                </button>
	            </a></h2>
			</div>
		</div>
	</div>	
</div>
	@endforeach
</div>
@stop
@section('customjs')
<script type="text/javascript">
    $(document).ready(function(){

        $.ajax({
	        url: "{{ url('hotel/ver/pdf/') }}" + "/" + $('#pdfButton').data('locata'), 
	        type: "GET",
	        dataType: 'html',
	        cache: false,   
	        success: function(data) {
	            $('#pdfButton').removeClass('btn-default');
	            $('#pdfButton').addClass('btn-primary');
	        },
	        error: function(data){
	            alert("Parece que ha habido un error al crear la factura. Por favor actualiza la pagina.");
	        }
	    });
    });
</script>
@stop
