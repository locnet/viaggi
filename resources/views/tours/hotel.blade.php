@extends('master')
@section('title','Home Page')
@section('tours','class="active"')
@section('customcss')
    <link rel="stylesheet" href="{{ asset('css/jquery.bxslider.css') }}">
    <link rel="stylesheet" href="{{ asset('gallery/css/jquery.galleryview-3.0-dev.css') }}">
@stop
@section('content')
    <div class="container">
        @foreach($hotel as $h)
            @foreach($h->getNodes($parserNodes['nod'],$parserNodes['subnod']) as $hotelData)
                <div class="col-md-6 col-xs-12 login">
                    <p><a href="{{ url('tour/'.$data->id) }}">
                            <button class="btn btn-info">
                                <span class="fa fa-arrow-left"></span>
                                    Volver al tour
                            </button>
                        </a>
                    </p>
                    <?php $stars = substr($hotelData['category_name'],0,1); ?>
                    <h3 class="lato red">
                        {{ strtoupper($hotelData['building_type_name']).' '.$hotelData['name'] }}
                    </h3>
                    <p>
                        @for($i = 0; $i<$stars;$i++)
                            <span class="fa fa-star "></span>
                        @endfor
                    </p> 
                    <h5 class="roboto"><b><span class="fa fa-map-marker"></span> </b>
                        {{ $hotelData['address'].', '.$hotelData['city'] }}
                    </h5>
                </div>
                <div class="col-md-6 col-xs-12 login">
                    <!-- saco las fotos de los hoteles -->
                    <ul class="bxslider">
                        @foreach($hotelData->PHOTOS->PHOTO as $p)
                            <li> 
                            	<img src="{{ url($p['url']) }}" class="img-responsive" 
                                      alt=" {{ $p['title'] }}"  />
                            </li>
                        @endforeach
                    </ul>                    
                </div>
                <div class="col-md-12 col-xs-12">
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
                    <div class="panel panel-default">
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
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title blue">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                <i class="fa fa-bed"></i>CAPACIDAD DEL HOTEL:
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
        @endforeach 
    </div>
@stop

@section('customjs')
    <script src="{{ asset('/js/jquery.bxslider.min.js') }}"></script>
    <script type="text/javascript">
        $('.bxslider').bxSlider({
            infiniteLoop: false,
            hideControlOnEnd: true
        });
    </script>
@stop