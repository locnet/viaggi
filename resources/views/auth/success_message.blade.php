@extends('master')

@section('content')
    <div class="container">
        <div class="row">
        	<div class="col-md-8 col-md-offset-2">
	            <h2 class="lato-300 dark-blue text-center">Gracias por registrate, {{ ucwords($user->name) }}</h2>
				<h3 class="lato-300">Hemos mandado un correo electonico con la confirmacion de tu registro. 
					Te rogamos que sigas las instrucciones que te hemos mandado para confirmar tu 
					registro.
				</h3>
				<h3 class="lato-300 text-center">Te esperamos encantados.</h3>
			</div>
        </div>
    </div>
@endsection