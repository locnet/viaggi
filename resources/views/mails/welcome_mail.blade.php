@extends('master')

@section('content')
    <div class="container">
        <div class="row">
        	<div class="col-md-8 col-md-offset-2">
	            <h2 class="lato-300 dark-blue text-center">Gracias por registrate {{ ucwords($user->name) }}</h2>
				<h4>Para terminar corectamente el proceso de registro de agencia te rogamos que has click en el
					siguiente enlace. Si el enlace no funciona copia y pega la siquiente direccion en tu 
					navegador preferido.</h4>
				<p><a href="{{ url('get-confirmation/'.$user->confirmation_code) }}">Enlace</a></p>
			</div>
        </div>
    </div>
@endsection
