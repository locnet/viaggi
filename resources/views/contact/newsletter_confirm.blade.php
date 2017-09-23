@extends('master')
@section('title','Suscribe a nuestro boletin de ofertas | Los mejores tours de Andalucia ')
@section('contact','class="active"')
@section('content')
    <section class="search-form-container">
        <div class="container">
        	<div class="row">
				<div class="col-md-8 col-md-offset-2 col-xs-12">				
					<div class="panel">
	                    <div class="panel-heading">
	                    	<h2 class="lato-300 text-center blue">Boletin de noticias</h2>
	                    </div>
	                    <div class="panel-body">
	                    	@if ($message === "new") 
	                    	    <h2 class="lato-300 text-center yellow">¡Gracias!</h2>
	                    	    <h3 class="lato-300 text-center"> Te estamos agradecidos por suscribir 
	                    	    	a nuestro boletin de noticias. Para terminar el proceso
	                    	    	comprueba tu bandeja de entrada y sigue las 
	                    	    	instucciones que te hemos mandado para terminar el proceso de suscripcion.
	                    	    	No olvides que puedes anular la suscripcion cuando quieras. </h3>
	                    	@elseif ($message === "confirm") 
	                    	    <h2 class="lato-300 text-center yellow">¡Bienvenido al club!</h2>
	                    	    <h3 class="lato-300 text-center"> Solo te molestaremos con noticias 
	                    	    importantes sobre nuevo tours y ofertas de Andaluciando Viaggi. No
	                    	    olvides que puedes darte de baja cuando quieras.  </h3>
	                    	@elseif ($message === "activated")
	                    	    <h2 class="lato-300 text-center yellow">¡Suscripcion activada!</h2>
	                    	    <h3 class="lato-300 text-center"> No es necesaria ninguna action mas.</h3>
	                    	@elseif ($message === "exist")
	                    	<h2 class="lato-300 text-center yellow">¡Upss!</h2>
	                    	    <h3 class="lato-300 text-center"> Este correo electronico existe en nuestra 
	                    	    	base de datos. No es necesario suscribir otra vez. </h3>
	                    	@elseif ($message === "deleted")
	                    	<h2 class="lato-300 text-center yellow">¿Pero por que?</h2>
	                    	    <h3 class="lato-300 text-center"> Tu correo electronico ha sido borrado de 
	                    	    	nuestros registros. Nos duele perderte,recuerda que eres 
	                    	    bienvenido cuando quieras. Gracias por el tiempo que estuviste con nosotros. </h3>
	                    	@elseif ($message === "no_user")
	                    	<h2 class="lato-300 text-center yellow">¡Upss!</h2>
	                    	    <h3 class="lato-300 text-center"> Este usuario no existe en nuestra base de 
	                    	    datos, seguro que ha sido borrado. Si has visto antes este mensaje y 
	                    	    siques recibiendo nuestro boletin de noticias contacte con nosotros. </h3>
	                    	    <h3 class="lato-300 text-center">¡Gracias!</h3>
	                    	@else<
	                    	    <h2 class="lato-300 text-center yellow">¡Upss!
	                    	    <h3 class="lato-300 text-center"> Ha ocurido un error inesperado. Te rogamos 
	                    	    	que lo intentes otra vez. Si el error presiste contacte con nosotros. </h3>
	                    	@endif
	                    </div>
	                </div>
				</div>
			</div>
		</div>
    </section>
@stop