@extends('master')
@section('title','Tours y hoteles en Andalucia ')
@section('tours','class="active"')
@section('content')
    <div class="container">
        <div class="row mobile-tour">            
            <div class="col-md-6 col-xs-4 login">                
                <img class="img-responsive" height="220" width="350"
                 src="{{ asset('admin/images/'.$data->foto) }}" />                
            </div>
            <div class="col-md-6 col-xs-8">
                <h2 class="roboto-700">{{ ucfirst($data->titulo) }}</h2>
                <h4 class="roboto orange"><i class="fa fa-calendar-check-o"></i>Disponible: 
                    {{ $data->start . ' al '.$data->fin }}
                </h4>
                <h5 class="roboto-700">{{ ucfirst($data->descripcion) }}</h5>
                <h5 class="roboto-700"> 
                    <a href="{{ url(asset('admin/pdf/'.$data->pdfa)) }}">
                        <span class="fa fa-file-pdf-o"></span>Ver pdf
                    </a>
                </h5> 
                <h3 class="lato-400">Precio: {{ $data->getTourPrice($data->precio) }}</h4> 
                <a href="{{ url('tour/all') }}">
                    <button class="btn btn-warning">
                        <span class="fa fa-arrow-left"></span>Volver
                    </button>  
                </a>
                <button class="btn btn-info pull-right">
                        <span class="fa fa-shopping-cart"></span>Reserva
                </button>                 
            </div>
        </div>
        
        <div class="row login">
            <div class="col-md-6 col-xs-12">
                <h3 class="roboto-700">Que haras en este tour:</h3>
                <ul>
                    <?php $days = explode("&",$data->dias);
                          $i = 1; ?>
                    @foreach($days as $dia)
                        <li>
                            <h4 class="roboto-700">Dia {{ $i}}</h4>
                            <p class="roboto-700">{{ $dia }}</p>
                        </li>
                        <?php $i++; ?>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-6 col-xs-12 mobile-tour">
                <h3 class="roboto-700">Alojamientos del tour</h3>
                
                @foreach($hotel as $h) 
                <div class="row mobile-tour login">                
                        @foreach($h->getNodes($parserNodes['nod'],$parserNodes['subnod']) as $hotelData)
                            <div class="col-md-12">
                            <h4 class="roboto-700 orange">
                                {{ $hotelData['building_type_name'] }}
                                {{ $hotelData['name'] }}
                            </h4>
                            </div>
                            <div class="col-md-5 col-xs-4">
                                <!-- saco solo la primera foto del hotel -->
                                <a href="{{ url('tour/'.$data->id.'/hotel/'.$hotelData['id']) }}">
                                    <img src="{{ url($hotelData->PHOTOS->PHOTO[0]['url']) }}" 
                                         class="img-responsive img-tour" width="180" height="130" />
                                </a>                                
                            </div>
                            <div class="col-md-7 col-xs-8">
                                <p class="roboto-700">{{ str_limit($hotelData->DESCRIPTION,190,'...') }} 
                                    <a href="{{ url('tour/'.$data->id.'/hotel/'.$hotelData['id']) }}">
                                        Ver mas
                                    </a>
                                </p>
                            </div>
                        @endforeach  
                    </div>     
                @endforeach               
            </div>
        </div>        
    </div>
@endsection

@section('customjs')
<script src="{{ asset('/js/jquery.imgFitter.js') }}"></script>
<script type="text/javacript">
    /*
    |---------- RESIZE IMAGENES RESULTADOS BUSQUEDA -----------|
    */
    $(function() {
        $(".img-resposive").imgFitter();
    });
    $(function() {
        $('.img-hotel').imgFitter();
    });
</script>
@endsection