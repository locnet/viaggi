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
        <h4 class="roboto">Tu estancia en 
            <span class="dark-blue"><strong>{{ $bookingData['buildingName'] }}</strong></span>
        </h4>
        <div class="col-md-4 col-xs-12 text-center">
            <img class="hotel-main-img text-center" 
              data-src="{{ url($bookingData['photoUrl']) }}"
              width="220px" height="150px" />
        </div>
        <div class="col-md-5 col-xs-12">
            <div class="row board-detail">
                <p class="blue"><strong>Ciudad:</strong> {{ $bookingData['city'] }}</p>
                <p class="blue">
                    <strong>Entrada: </strong>
                    {{ \Carbon\Carbon::parse($bookingData['entrada'])->format('d-m-Y') }}
                    <strong>, salida: </strong>
                    {{ \Carbon\Carbon::parse($bookingData['salida'])->format('d-m-Y') }}
                </p>
                <p class="blue"><strong>Habitaciones:</strong> {{ $bookingData['roomsNumber'] }}</p>
                <p class="blue"><strong>Regimen: </strong>
                    {{ $bookingData['boardName'] }}
                </p>
                <p class="blue"> <strong>Huespedes: </strong>
                    {{ $bookingData['adultos'] }}
                    @if($bookingData['adultos'] > 1)
                         adultos
                    @else
                        adulto
                    @endif
                    @if($bookingData['menores'] > 0)
                        y {{ $bookingData['menores'] }}
                        @if($bookingData['menores'] > 1)
                            niños
                        @else
                            niño
                        @endif 
                    @endif
                </p>
            </div>
        </div>
        <div class="col-md-3 col-xs-12 board-price">
            <h4 class="white text-center roboto">
                Total a pagar:
            </h4>
            <h2 class="text-center white">
                {{ number_format($bookingData['totalPrice'] * $bookingData['roomsNumber'],2) }} €
            </h2>

        </div>
    </div>
</div>
<div class="container">
    <div class="col-md-10 col-md-offset-1 login">
        <h4 class="roboto">
            Vamos a confirmar la reserva, falta poco
        </h4>               
        {!! Form::open(['url' => '/hotel/confirmar',null,'class' => 'form-horizontal',
                                  'id' => 'booking_confirm']) !!}
        {!! csrf_field() !!}
        <div class="row board"> 
            <div class="col-md-12 col-xs-12">   
                @for($i = 1; $i <=$bookingData['roomsNumber'];$i++)
                <?php $r = 'room_'.$i; ?>
                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">                	
                  	<div class="col-md-4 control-label">                            		
                  		{!! Form::label('room_'.$i.'_contact', 'Habitacion '.$i.', nombre completo:') !!}                  		
                  	</div>
                    <div class="col-md-8">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="fa fa-male"></span>
                            </div> 
                            	{!! Form::input('text','room_'.$i.'_contact',null, 
                                                  ['class' => 'form-control',
                                                  'id' => 'first_room']) 
                                !!} 
                        </div>                            
                    </div>                             
                </div>
                @endfor
            </div>            
        </div> 
        <h4 class="roboto">
            Titular de la reserva
        </h4>
        <div class="row board">
            <div class="col-md-6 col-xs-12">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <div class="col-md-3 control-label">
                        {!! Form::label('name','Nombre:') !!}
                    </div>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="fa fa-male"></span>
                            </div> 
                                {!! Form::input('text','name',old('name'), 
                                                  ['class' => 'form-control',
                                                  'id' => 'name']) 
                                !!}
                        </div>
                    </div>                                       
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                    <div class="col-md-3 control-label">
                        {!! Form::label('last_name','Apellido:') !!}
                    </div>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="fa fa-male"></span>
                            </div> 
                              {!! Form::input('text','last_name',old('last_name'), 
                                                  ['class' => 'form-control',
                                                  'id' => 'last_name']) 
                                !!}
                        </div>                      
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="col-md-3 control-label">
                        {!! Form::label('email','Correo:') !!}
                    </div>

                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="fa fa-envelope"></span>
                            </div>
                            {!! Form::input('email','email',old('email'),
                                           ['class'=>'form-control']) 
                            !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <div class="col-md-3 control-label">
                        {!! Form::label('phone','Telefono:') !!}
                    </div>

                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="fa fa-phone"></span>
                            </div>
                            {!! Form::input('tel','phone',old('phone'),
                                           ['class'=>'form-control']) 
                            !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xs-12">
                <div class="form-group">
                    <div class="col-md-9 col-xs-12">
                        <label class="control-label">
                        {!! Form::checkbox('terms',old('terms'),
                                       ['class'=>'form-control']) 
                        !!}
                         
                        Declaro aver leido las <a href="#"><span class="orange">
                        CONDICIONES GENERALES</span></a> de la reserva.
                        </label>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                            <div class="col-md-12 col-xs-12">
                                <button type="submit" class="btn btn-primary pull-right">
                                    <i class="fa fa-arrow-right"></i>Siquiente
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>       
        </div>       
            {!! Form::hidden('roomsNumber',$bookingData['roomsNumber']) !!}
            {!! Form::hidden('destino') !!}
            {!! Form::hidden('zona',0) !!}
            {!! Form::hidden('city',$bookingData['city']) !!}
            {!! Form::hidden('buildingName',$bookingData['buildingName']) !!}
            {!! Form::hidden('buildingId',$bookingData['buildingId']) !!}
            {!! Form::hidden('photoUrl',$bookingData['photoUrl']) !!}
            {!! Form::hidden('boardId',$bookingData['boardId']) !!}
            {!! Form::hidden('boardName',$bookingData['boardName']) !!}
            {!! Form::hidden('aco') !!}
            {!! Form::hidden('hotelPrice',$bookingData['hotelPrice']) !!}
            {!! Form::hidden('totalPrice',number_format($bookingData['totalPrice'],2)) !!}                                        
            {!! Form::hidden('entrada') !!}
            {!! Form::hidden('salida') !!}
            {!! Form::hidden('adultos') !!}
            {!! Form::hidden('menores') !!}
            {!! Form::hidden('roomsNumber') !!}
            @if ($rooms = Form::old('roomsNumber') ?: 1) @endif
            @for ($i=1; $i <= $rooms;$i++)
                {!! Form::hidden('adult_in_room_'.$i) !!}
                {!! Form::hidden('child_in_room_'.$i, 0) !!}
                {!! Form::hidden('room_'.$i.'_age_0', 0) !!}
                {!! Form::hidden('room_'.$i.'_age_1', 0) !!}
            @endfor
        {!! Form::close() !!}
    </div><!-- fin login -->
</div><!-- fin container -->
@endsection


@section('customjs')
<script src="{{ asset('/js/jquery.imgFitter.js') }}"></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script type="text/JavaScript">
/*
|---------- RESIZE IMAGENES RESULTADOS BUSQUEDA -----------|
*/
    $(function() {
        $(".hotel-main-img").imgFitter();
    });
/*
|------------ VALIDACION -----------------------------------|
*/
$(document).ready(function(){
    $('#booking_confirm').validate({
        rules: {
            <?php
                $rooms = $bookingData['roomsNumber'];
                for ($i=1; $i<=$rooms;$i++){
                    echo "room_".$i."_contact:{required:true, minlength: 3},";
                }
            ?>
            name:{
                required:true,
                minlength:3
            },
            last_name:{
                required:true,
                minlength: 3
            },
            phone: {
                required: true,
                minlength: 9,

            },
            email: {
                required: true,
                email: true
            },
            terms: {
                required: true
            }
        },
        messages:{
            <?php
                for ($i=1; $i<=$rooms;$i++){
                    echo "room_".$i."_contact:{required:'El nombre del ocupante principal!',
                                       minlength: 'Nombre demasiado corto!'},";
                }
            ?>
            name: {
                required: "El nombre es obligatorio!",
                minlength: "El nombre debe tener minimo 5 letras!"
            },
            last_name: {
                required: "El apellido es obligatorio!",
                minlength: "El Apellido debe tener minimo 5 letras!"
            },
            phone: {
                required: "El telefono el obligatorio!",
                minlength: "Numero demasiado corto!"
            },
            email: {
                required: "Falta el correo elctronico!",
                email: "Formato incorecto!"
            },
            terms: {
                required: "Tienes que acceptar las condiciones de la reserva!"
            }
        },
        highlight: function(element, errorClass,validClass){
            $(element).parents('div.form-group').addClass('has-error');
        },
        unhighlight: function(element, errorClass){
            $(element).parents('div.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            var a = "";
            if (element.closest('.col-md-9').length > 0) {
                a = element.closest('.col-md-9');
            } else {
                a = element.closest('.col-md-8');
            }
            error.appendTo(a);
            console.log(element.attr('name'));
        }
    });
});

</script>

@endsection