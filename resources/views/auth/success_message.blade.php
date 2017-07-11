@extends('master')

@section('content')
    <div class="container">
        <div class="row">
        	<div class="col-md-8 col-md-offset-2">
	            <h2 class="lato-300 dark-blue text-center">Gracias por registrate {{ ucwords($user->name) }}</h2>
				<h4>Mira tu correo electronico, queda una ultima cosa por hacer.</h4>
			</div>
        </div>
    </div>
@endsection