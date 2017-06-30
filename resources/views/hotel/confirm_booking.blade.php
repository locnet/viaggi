@extends('master')
@section('title','Ofrecemos hoteles baratos | Habitaciones baratas en la playa')
@section('meta_description','Andalusiandoviaggi ofrece los mejores precios en habitaciones de
hotel en la playa.')
@section('hotel','class="active"')
@section('customcss')
    
@stop

@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-1 col-xs-12 login">
    	<div class="col-md-12 col-xs-12 board-price">
    	<h2 class="lato-300 text-center white">
    		Estos son los detalles de tu reserva. Revisala por favor.
    	</h2> 
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="row board-detail">
            	<h3 class="roboto blue">{{ $payData['buildingName'] }}</h3>
                <p><strong>Ciudad:</strong> {{ $payData['city'] }}</p>
                <?php
                    // numero de noches
                    // timestamp fecha entrada y salida
                    $in = Carbon\Carbon::createFromFormat('Y-m-d',$payData['entrada'])->timestamp;
                    $out = Carbon\Carbon::createFromFormat('Y-m-d', $payData['salida'])->timestamp;
                    $diff = $out - $in;
                    // 1 dia = 86400 secundos
                    $days = $diff/86400;
                ?>
                <p><strong>Noches: </strong>{{ $days }}</p>
                <p><strong>Entrada: </strong>
                    {{ Carbon\Carbon::parse($payData['entrada'])->format('d-m-Y') }}
                    <strong>, salida: </strong>
                    {{ Carbon\Carbon::parse($payData['salida'])->format('d-m-Y') }}
                </p>
                <p><strong>Habitaciones:</strong> {{ $payData['roomsNumber'] }}</p>
                <p><strong>Regimen: </strong>{{ $payData['boardName'] }}</p>
                <p> <strong>Huespedes: </strong>
                    {{ $payData['adultos'] }}
                    @if($payData['adultos'] > 1)
                         adultos
                    @else
                        adulto
                    @endif
                    @if($payData['menores'] > 0)
                        y {{ $payData['menores'] }}
                        @if($payData['menores'] > 1)
                            niños
                        @else
                            niño
                        @endif 
                    @endif
                </p>
                <p><strong>Titular de la reserva: </strong>
                    {{ strtoupper($payData['name']. " ". $payData['last_name']) }}
                </p>
                <p><strong>Correo electronico: </strong>{{ $payData['email'] }}</p>
            </div>
        </div>
        <div class="col-md-6 col-xs-12 table-responsive login" style="border: 1px solid #cacaca">
            <table class="table">
                <tr>
                    <td><h4 class="roboto blue">Precio reserva:
                        <?php $iva = number_format($payData['totalPrice'] - 
                                      ($payData['totalPrice'] / 1.21),2);
                        ?>
                        </h4>
                    </td>
                    <td><h4>{{ number_format($payData['totalPrice'] - $iva, 2) }} €</h4></td>
                </tr>
                <tr>
                    <td><h4 class="roboto blue">IVA:</h4></td>
                    <td><h4>{{ $iva }} €</h4></td>
                </tr>
                <tr>
                    <td><h4 class="blue roboto"><strong>Total a pagar:</strong></h4></td>
                    <td><h4>{{ number_format($payData['totalPrice'],2) }} €</h4></td>
                </tr>
            </table>
            <img data-src="{{ asset('images/creditcard.jpg') }}" title="pago con tarjeta"
                            class="cc-img" width="150px" height="30px" />
        </div>
        <div class="row">
            <div class="col-md-12">
		    <form action="{{ url('/hotel/pagar') }}" method="POST">
		        {!! csrf_field() !!}
                {!! Form::hidden('amount',$payData['totalPrice']) !!}
                {!! Form::hidden('description',"Pago Andalusiando Viaggi") !!}
                {!! Form::hidden('buildingId') !!}
                {!! Form::hidden('photoUrl') !!}
                {!! Form::hidden('boardId') !!}
                {!! Form::hidden('boardName') !!}
                {!! Form::hidden('aco') !!}
                {!! Form::hidden('hotelPrice') !!}
                {!! Form::hidden('totalPrice',number_format($payData['totalPrice'],2)) !!}                                        
                {!! Form::hidden('entrada') !!}
                {!! Form::hidden('salida') !!}
                {!! Form::hidden('adultos') !!}
                {!! Form::hidden('menores') !!}
                {!! Form::hidden('email', $payData['email']) !!}
                {!! Form::hidden('name',$payData['name']) !!}
                {!! Form::hidden('last_name',$payData['last_name']) !!}
                {!! Form::hidden('phone') !!}
                {!! Form::hidden('roomsNumber') !!}
                @if ($rooms = Form::old('roomsNumber') ?: 1) @endif
                @for ($i=1; $i <= $rooms;$i++)
                    {!! Form::hidden('adult_in_room_'.$i) !!}
                    {!! Form::hidden('child_in_room_'.$i, 0) !!}
                    {!! Form::hidden('room_'.$i.'_age_0', 0) !!}
                    {!! Form::hidden('room_'.$i.'_age_1', 0) !!}

                    {!! Form::hidden('room_'.$i.'_contact') !!}
                @endfor

			    <script
				    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
				    data-key="pk_test_xq28spRMPZ1WBbGMfqcacdOG"
				    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
				    data-name="Andalusiando Viaggi"
			        data-label="Pagar ahora"
			        data-email="{{ $payData['email'] }}"
				    data-description="El pago de tu reserva"
				    data-amount="{{ ($payData['totalPrice'] * 100) }}"
				    data-locale="es">
			    </script>
		    </form>
            </div>
        </div>
        <div class="login">
        	<h4 class="red roboto">El pago de tu reserva va a ser procesado por stripe.com, empresa 
        	lider en procesamiento de pagos online. La conexion con el servidor de stripe.com 
        	esta encriptada, andalusiandoviaggi.com no vera en ningun momento los datos de tu
        	tarjeta. </h4>
        </div>
    </div>
    
</div>
@endsection

@section('customjs')
<script src="{{ asset('/js/jquery.imgFitter.js') }}"></script>
<script type="text/JavaScript">
/*
|---------- RESIZE IMAGENES RESULTADOS BUSQUEDA -----------|
*/
    $(function() {
        $(".cc-img").imgFitter();
    });
</script>
@endsection