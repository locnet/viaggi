@extends('master')
@section('title','Busqueda de hoteles en Andalucia | Hoteles en la costas andaluzas')
@section('meta_description','Andalusiandoviaggi vende tours y reservas de hoteles a agencias 
y particulares. Los mejores precios para hacer tours de Andalucia.')
@section('hotel','class="active"')
@section('customcss')
    <link rel="stylesheet" href="{{ asset('datepicker/css/datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.bxslider.css') }}">
@stop
@section('content')
    <div class="container login">
        <div class="col-md-12 col-xs-12">
            {{-- los parametros que vienen de BookingController, en el caso de que el usuario 
            pulsa volver tenemos que repetir la busqueda con los mismos parametros y 
            ademas filtrar los rezultados si el usuario habia usado el filtro  --}}

            {!! Form::open(['url' => '/hotel/search',null,'class' => 'form-horizontal']) !!}
                {!! csrf_field() !!}
                {!! Form::hidden('destino') !!}
                {!! Form::hidden('zona',0) !!}
                {!! Form::hidden('entrada') !!}
                {!! Form::hidden('salida') !!}
                {!! Form::hidden('roomsNumber') !!}
                @if ($rooms = Form::old('roomsNumber') ?: 1) @endif

                @for ($i=1; $i <= $rooms;$i++)
                    {!! Form::hidden('adult_in_room_'.$i) !!}
                    {!! Form::hidden('child_in_room_'.$i, 0) !!}
                    {!! Form::hidden('room_'.$i.'_age_0', 0) !!}
                    {!! Form::hidden('room_'.$i.'_age_1', 0) !!}
                @endfor

                {{-- tengo en cuenta los filtros activos y el 
                     numero de la pagina desde donde he llegado 
                     para volver a la misma  --}}
                {!! Form::hidden('activePage',$activePage) !!}
                {!! Form::hidden('activeCategory') !!}
                {!! Form::hidden('activePrice') !!}
                <button type="submit" class="btn btn-success">
                    <span class="fa fa-arrow-circle-left"></span>
                    Volver a los resultados
                </button>  
            {!! Form::close() !!}
        </div>
    </div><!-- fin container --> 
   
    <div class="container">

        {{-- DETALLES HOTEL SERVICIO 200--}}
        @foreach($hotel->getNodes("BUILDING", false) as $hotelData)            
        <div class="col-md-12 col-xs-12">
            <?php $stars = substr($hotelData['category_name'],0,1); ?>
            <h3 class="lato-200 dark-blue">
                <?php $hotelName = strtoupper($hotelData['building_type_name']).' '.$hotelData['name'];?>
                {{ $hotelName }}
            </h3>            
            <p>
                
            <b><span class="fa fa-map-marker"></span> </b>
                {{ $hotelData['address'].', '.$hotelData['city'] }}
                @for($i = 0; $i<$stars;$i++)
                    <span class="fa fa-star "></span>
                @endfor
            </p>
        </div>
        <div class="col-md-7 col-xs-12">
            <!-- saco las fotos de los hoteles -->
            <ul class="bxslider" style="background-color: #f5f5f5">
            @foreach($hotelData->PHOTOS->PHOTO as $p)
                <li> 
                    <img src="{{ url($p['url']) }}" class="img-responsive" 
                          alt=" {{ $p['title'] }}"  />
                </li>
            @endforeach
            </ul>                    
        </div>
        <div class="col-md-5">
             <iframe
                        width="100%"
                        height="260"
                        frameborder="0" style="border:0"
                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCAOM3Lmi2fBwTPTnBV7WRWqCpilBGbBSg
                        &q=hotel+{{$hotelData['name']}},
                        {{$hotelData['zone_name']}}+{{$hotelData['destination_name']}}" allowfullscreen>
                    </iframe>
        </div>
        @endforeach
    </div> <!-- fin container -->
    
    <div class="container">
        <div class="col-md-12 col-xs-12">
        {{-- DETALLES ACOMODACIONES // SERVICIO 1400 --}}           

            @foreach($acomod->getNodes("BUILDING_SET", false) as $a)
                <h3 class="lato-300 dark-blue text-center">
                    @if ($roomsNumber > 1) 
                        {{ $roomsNumber }} habitaciones
                    @else 
                        {{ $roomsNumber }} habitacion
                    @endif
                    , entrada en {{ $a['check_in'] }} y salida en {{ $a['check_out'] }}
                </h3>
                <?php $photoUrl = $a->BUILDING['photo_url'];
                      $buildingId = $a->BUILDING['id']; 
                      $city = $a->BUILDING['zone_name'];
                ?>
                
                @foreach($a->BUILDING->BOARD as $board)
                <div class="row board">
                    <?php
                    if($board['pvp_type']) {
                        $priceType= $board['pvp_type'];
                    } else{
                        $priceType = "R";
                    }
                     //total personas, habitaciones
                     $personInRoom = 0;
                     $adultos = 0;
                     $menores = 0;
                     $roomsNumber = 0;
                     $hotelPvpPrice= 0;
                     // regimen
                     $boardId = $board['id'];
                     $boardName = $board['name'];
                    ?>
                    
                    @foreach($board->ROOM as $room)
                        <?php
                        //adultos y niños en las habitaciones
                        $adultos += $room['adults'];
                        $menores += $room['children'];
                        $personInRoom += $room['adults'] + $room['children']; 
                        ?>
                    @endforeach
                    <?php
                    //saco el numero y el id de las acomodaciones, de la primera habitacion.
                    $acomos = array();
                    for($i=1; $i<=1; $i++){
                        foreach($room->ACOMODATION as $c) {
                            $acomos[] = $c['id'];
                        }
                    }
                    ?>
                    <div class="col-md-4 col-xs-12 board-name">
                        <h4 class="roboto">
                            @if($board['id'] == "A")
                                <i class="fa fa-bed"></i>
                            @elseif($board['id'] == "D")
                                <i class="fa fa-coffee"></i>
                            @elseif($board['id'] == "M")
                                <i class="fa fa-coffee"></i>
                                <i class="fa fa-cutlery"></i>
                            @elseif($board['id'] == "C")
                                <i class="fa fa-coffee"></i>
                                <i class="fa fa-cutlery"></i>
                                <i class="fa fa-glass"></i>
                            @elseif($board['id'] == "T")
                                <i class="fa fa-coffee"></i>
                                <i class="fa fa-cutlery"></i>
                                <i class="fa fa-glass"></i>
                            @endif 
                     
                            <span class="white">{{ $board['name'] }}</span>
                        </h4>
                    </div>
                    <div class="col-md-8 col-xs-12">                        
                    
                    @foreach($acomos as $acId)
                        <?php
                        $totalPrice = 0;
                        $roomPrice  = 0;
                        $hotelPrice = 0;
                        $hotelPvpPrice = 0;
                        ?>

                        @foreach($board->ROOM as $room)
                            @foreach($room->ACOMODATION as $acom)
                                <?php $myId = $acom['id'] ?>

                                {{-- si los id coinciden las acomodaciones son iguales 
                                    asi que las sumamos --}}

                                @if (strval($myId) == strval($acId))
                                    {{-- calculo el precio solo por esta acomodacion
                                         total precio a pagar a sidetour --}}
                                    <?php

                                    $hotelPrice += $acom['price'];
                                    $hotelPvpPrice += $acom['price_pvp'];
                                    $roomPrice = $procent->makeHotelPrice(
                                                    $procent,
                                                    $priceType,
                                                    $acom['price'],
                                                    $acom['price_pvp']
                                                );
                                   
                                    // precio total, suma de las acomodaciones
                                    $totalPrice += str_replace(",","",$roomPrice);
                                    ?>                                
                                    <div class="row  board-container">
                                        <?php $myId = $acom['id']; ?>
                                        <div class="col-md-9 col-xs-7">
                                            <h5 text-center>{{ $acom['name'] }}
                                                @if($acom['non_refundable'] == 0)
                                                    <span class="small red">
                                                        (cancelacion gratuita*)
                                                    </span>
                                                @endif
                                                <strong>Adultos:</strong> {{ $adultos }}                                                
                                                @if (strval($room['children']) > 0)
                                                    <strong>Niños:</strong> {{ $room['children'] }}
                                                @endif
                                            </h5>
                                        </div>
                                        {!! Form::open(['url' => '/hotel/reservar',null,'class' => 'form-horizontal']) !!}
                                        {!! csrf_field() !!}
                                        {!! Form::hidden('destino') !!}
                                        {!! Form::hidden('zona',0) !!}
                                        {!! Form::hidden('city',$city) !!}
                                        {!! Form::hidden('buildingName',$hotelName) !!}
                                        {!! Form::hidden('buildingId',$buildingId) !!}
                                        {!! Form::hidden('photoUrl',$photoUrl) !!}
                                        {!! Form::hidden('boardId',$boardId) !!}
                                        {!! Form::hidden('boardName',$boardName) !!}
                                        {!! Form::hidden('aco',$acId) !!}
                                        {!! Form::hidden('hotelPrice',$hotelPrice) !!}
                                        {!! Form::hidden('totalPrice',$totalPrice) !!}                                        
                                        {!! Form::hidden('entrada') !!}
                                        {!! Form::hidden('salida') !!}
                                        {!! Form::hidden('adultos',$adultos) !!}
                                        {!! Form::hidden('menores',$menores) !!}
                                        {!! Form::hidden('roomsNumber') !!}
                                        @if ($rooms = Form::old('roomsNumber') ?: 1) @endif

                                        @for ($i=1; $i <= $rooms;$i++)
                                            {!! Form::hidden('adult_in_room_'.$i) !!}
                                            {!! Form::hidden('child_in_room_'.$i, 0) !!}
                                            {!! Form::hidden('room_'.$i.'_age_0', 0) !!}
                                            {!! Form::hidden('room_'.$i.'_age_1', 0) !!}
                                        @endfor
                                        <div class="col-md-3 col-xs-5 board-price">
                                            <button class="no-style" type="submit">                                                
                                                <h4 class="lato-200 white pull-left">
                                                    <span class="fa fa-shopping-cart"></span>
                                                    {{ number_format($totalPrice,2) }} €
                                                </h4>
                                           </button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                @endif                               
                            @endforeach {{-- endforeach $room->ACOMODATION --}}                            
                        @endforeach     {{-- endforeach $board->ROOM --}}
                    @endforeach         {{-- endforeach $acomos --}}                         
                    </div>
                </div>
                @endforeach {{-- endforeach $a->BUILDING->BOARD --}}
            @endforeach
            <p class="orange roboto"> * Cancelacion gratuita con 5 dias de antelacion</p>
        </div>
    </div><!-- fin container -->

    <div class="container">
        <div class="col-md-12 col-xs-12">
            {{-- DETALLES HOTEL SERVICIO 200--}}
            @foreach($hotel->getNodes("BUILDING", false) as $hotelData)
                <div class="row">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title blue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse0">
                                <i class="fa fa-info-circle"></i>DESCRIPCION
                                <i class="fa fa-angle-right pull-right"></i></a>
                              </h4>
                            </div>
                            <div id="collapse0" class="panel-collapse collapse">
                              <div class="panel-body">
                                <p class="roboto">{{ $hotelData->DESCRIPTION }}</p>
                              </div>
                            </div>
                        </div>
                        <div class="panel panel-default hidden-md hidden-lg">
                            <div class="panel-heading">
                              <h4 class="panel-title blue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                <i class="fa fa-building-o"></i>EDIFICIO:
                                <i class="fa fa-angle-right pull-right"></i></a>
                              </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse">
                              <div class="panel-body">
                                <h4 class="roboto blue">                   
                                    <ul class="col-md-12 ">
                                    @foreach($hotelData->CHARACTERISTICS->CHARACTERISTIC as $service)                             
                                        @if($service['type'] == 'EDI')
                                            <li class="col-md-3 col-xs-12">
                                                <p class="small">{{ $service['name'].
                                                    ': '. $service['value'] }} </p>                                
                                            </li>
                                        @endif
                                    @endforeach
                                    </ul>
                                </h4>
                              </div>
                            </div>
                        </div>
                        <div class="panel panel-default hidden-md hidden-lg">
                            <div class="panel-heading">
                              <h4 class="panel-title blue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                    <i class="fa fa-bed"></i>HABITACIONES:
                                    <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                              <div class="panel-body">
                                <h4 class="roboto blue">                   
                                    <ul class="col-md-12">
                                    @foreach($hotelData->CHARACTERISTICS->CHARACTERISTIC as $service)                             
                                        @if($service['type'] == 'CAP')
                                            <li class="col-md-3 col-xs-12">
                                                <span class="small">{{ $service['name'].
                                                ': '. $service['value'] }}</span>                                
                                        @endif
                                    @endforeach
                                    </ul>
                                </h4>
                              </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title blue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                    <i class="fa fa-location-arrow"></i>ALREDEDORES:
                                    <i class="fa fa-angle-right pull-right"></i></a>
                              </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                              <div class="panel-body">
                                <h4 class="roboto blue">                   
                                    <ul class="col-md-12">
                                    @foreach($hotelData->CHARACTERISTICS->CHARACTERISTIC as $service)                             
                                        @if($service['type'] == 'DIS')
                                            <li class="col-md-3 col-xs-12">
                                                <span class="small">{{ $service['name'].
                                                    ': '. $service['value'] }}</span>   
                                            </li>
                                        @endif
                                    @endforeach
                                    </ul>
                                </h4>
                              </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title blue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                    <i class="fa fa-television"></i>ENTRETENIMIENTO:
                                    <i class="fa fa-angle-right pull-right"></i></a>
                              </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse">
                              <div class="panel-body">
                                <h4 class="roboto blue">                   
                                    <ul class="col-md-12"> 
                                    @foreach($hotelData->SERVICES->SERVICE as $service)                             
                                        @if($service['type'] == 'ENT')
                                            <li class="col-md-3 col-xs-12">
                                                <span class="small">{{ $service['name'] }}</span> 
                                            </li>                               
                                        @endif
                                    @endforeach
                                    </ul> 
                                </h4>
                              </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title blue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                    <i class="fa fa-wifi"></i>SERVICIOS HABITACION:
                                    <i class="fa fa-angle-right pull-right"></i></a>
                              </h4>
                            </div>
                            <div id="collapse5" class="panel-collapse collapse">
                              <div class="panel-body">
                                <h4 class="roboto blue">                   
                                    <ul class="col-md-12">
                                    @foreach($hotelData->SERVICES->SERVICE as $service)                             
                                        @if($service['type'] == 'HAB')
                                            <li class="col-md-3 col-xs-12">
                                                <span class="small">{{ $service['name'] }}</span>                                
                                            </li>
                                        @endif
                                    @endforeach
                                    </ul>
                                </h4>
                              </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title blue">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                                    <i class="fa fa-glass"></i>SERVICIOS DEL HOTEL:
                                    <i class="fa fa-angle-right pull-right"></i></a>
                              </h4>
                            </div>
                            <div id="collapse6" class="panel-collapse collapse">
                              <div class="panel-body">
                                <h4 class="roboto blue">                   
                                    <ul class="col-md-12">
                                    @foreach($hotelData->SERVICES->SERVICE as $service)                             
                                            @if($service['type'] == 'GEN')
                                            <li class="col-md-3 col-xs-12">
                                                <span class="small">{{ $service['name'] }}</span>                                
                                            </li>
                                            @endif
                                    @endforeach
                                    </ul>
                                </h4>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach 
        </div>      
    </div>
@endsection

@section('customjs')    
    <script src="{{ asset('/js/jquery.imgFitter.js') }}"></script>
    <script src="{{ asset('/js/jquery.bxslider.min.js') }}"></script>
    <script type="text/javascript">
        $('.bxslider').bxSlider({
            infiniteLoop: false,
            hideControlOnEnd: true
        });
    </script>
@endsection