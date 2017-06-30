<!DOCTYPE html>
<html lang="en">
    <head>
	    <meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content=" @yield('meta_description') ">
	    <meta name="google-signin-client_id" content="@yield('google_profile_id')">
		<title>@yield('title')</title>				
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="{{ asset('css/mystyle.css') }}">
		@yield('customcss')		
    </head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-offset-1 col-md-10 col-xs-12 pdf">
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
						<table class="table table-bordered table-striped table-condensed">
							<tr>
								<td><img src="{{ asset('images/logoviaggi2.png') }}" class="responsive"
								              width="200px" height="100px" style="margin: 40px 20px"/></td>
								<td>
									<h3 class="lato-300 dark-grey">Andalusiando Viaggi</h3>
									<p class="lato-300 dark-grey">Calle Obsidiana Nº 1, 9 A, 
									Edificio Alfa, 29006 - Malaga, España</br>
						            Tel/Fax +34 951 38 04 50</br>
						            Mobil +34 664 64 81 97</br>
									info@andalusiandoviaggi.com</br>
									comercial@andalusiandoviaggi.com</br>
									</p>
								</td>
							<tr>
								<td><p class="lato-300 dark-grey"><i class="fa fa-calendar"></i>
									Fecha reserva: {{ $b['date_dmy'] }}</p>
								</td>
								<td><p class="lato-300 dark-grey">Numero confirmacion: {{ $locata }}</p></td>
							</tr>
							<tr>
								<td><p class="lato-300 dark-grey"><i class="fa fa-h-square"></i>
									{{ $buildingType }} {{ $b['building_name'] }}</p></td>
								<td>
                                    <p class="lato-300 dark-grey">{{ $b['zone_name'] }}, 
					                    {{ $postcode .' - '. $b['destination_name'] }}</br>
							    		Telefono: {{ $tel }}</br>
							    		{{ $email }}
							    	</p>
								</td>
							</tr>
							<tr>
								<td><p class="lato-300 dark-grey"><i class="fa fa-bed"></i>
									Habitacion {{ $b->ROOM['aco_name'] }}</p></td>
								<td><p class="lato-300 dark-grey">
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
		                            , {{ lcfirst($b['board_name']) }}</p>
								</td>
							</tr>   
				            <tr>
						    	<td><p class="lato-300 dark-grey">
						    		<i class="fa fa-calendar"></i>Estancia</p>
						    	</td>
						    	<td>
						    		<p class="lato-300 dark-grey">Entrada: {{ $b['check_in_dmy'] }}
						    			, salida: {{ $b['check_out_dmy'] }}</p>
						    	</td>
						    </tr>
						    <tr>
						    	<td>
						    		<p class="lato-300 dark-grey">
						    			<i class="fa fa-remove"></i>Cancelacion</p>
						    	</td>
						    	<td>
						    		<p class="lato-300 dark-grey">
						    			Gratuita antes del {{ $b->ROOM->CANCEL_POLICIES->{0}['from_dmy'] }}
						    		</p>
						    	</td>
			    	        </tr>			    		
						</table>
						<h3 class="lato-300 pull-right"><i class="fa fa-cc-visa"></i>Precio pagado:
				    		<strong><span class="blue">{{ number_format($reserva->precio,2) }} €</span>
				    		</strong>
				    		<span class="small grey">(IVA incluido)</span>
				    	</h3>				   			
		            @endforeach
		         </div>	
	            <div class="col-md-12">
	            	<p class="roboto dark-grey small">
                    Atencion !! Esta reserva no admite modificaciones de ningun tipo. 
                    En caso de querer cambiar algun dato de la reserva 
                    (nombre, dia, numero de habitaciones, etc) debera hacer una reserva nueva y 
                    contactar con nosotros para cancelar esta.
                    En el caso de cancelar / modificar esta reserva con menos de 5 dias hasta
                    el check-in, se generaran gastos del 100,00 % sobre el importe total de la reserva. 
                    Tenga en cuenta que, una vez realizado el check-in, y en caso de salida
                    anticipada, el hotel esta facultado para facturar el 100% sobre el total de la estancia.
                    En caso de no presentacion (no-show), el hotel/proveedor del servicio, 
                    tambien esta facultado para facturar el 100% sobre el total del servicio contratado.</p>
                    <p class="lato-300 dark-grey small">
                    	IMPORTANTE:</br>
					RESERVA GARANTIZADA, INCLUSO LLEGANDO EL CLIENTE DESPUES DE LAS 18:00 HORAS,EXCEPTO EN
					AQUELLOS ESTABLECIMIENTOS EN QUE SE INDIQUE LO CONTRARIO. EN EL CASO DE NO PRESENTACION
					SE GENERARAN GASTOS. ESTOS GASTOS DEPENDERAN DEL PAIS, ESTABLECIMIENTO Y TEMPORADA, LOS
					CUALES SERAN INFORMADOS EN SU MOMENTO.
					CUALQUIER MODIFICACION (SEA DE FECHA, TIPO DE SERVICIO, NUMERO DE PERSONAS, NOMBRE DE
					PASAJEROS, ETC) PUEDE IMPLICAR UN CAMBIO EN EL PRECIO DE ESTA RESERVA.
					ESTA RESERVA NO SE CONSIDERARA CANCELADA, SI NO SE NOS FACILITA EL LOCALIZADOR DE
					CANCELACION.
					LAS RESERVAS CONFIRMADAS POR ANDALUSIANDO VIAGGI INCLUYEN LOS IMPUESTOS GENERALES DE
					CADA PAIS IVA O SIMILAR).</br>
					
					ANDALUSIANDO VIAGGI le informa de forma expresa, precisa e inequivoca que de conformidad con la Ley 15/99 de
					13 de Diciembre, de Proteccionn de Datos de Caracter Personal, los datos de 
					caracter personal insertos en el presente
					documento, seran incorporados a un fichero de su titularidad ,
					 con el fin de gestionar las reservas y su posterior
					facturacion, pudiendo ejercitar en todo momento los derechos de acceso, 
					rectificacion y cancelacion en Calle Obsidiana Nr. 1/9A, 29006, Malaga.
					Ref. (Proteccion de Datos).</p>
					<p class="lato-300 small dark-grey">
					Gracias por confiar en nosotros. Andalusiando Viagigi, C.I.AN - 292010 - 3, C.I.F. B92995927</p>
			    </div>
			</div>
		</div>
	</body>
</html>