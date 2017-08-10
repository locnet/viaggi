@extends('master')
@section('title','Circuitos por Andalucia | Viajar por Andalucia con Andalusiando')
@section('inicio','class="active"')
@section('content')

    <section>  
        <div class="full-page-container">
            <h3 class="lato-extra-big yellow text-center">Tus clientes necesitan ver lo mejor de Andalucia</h3>
            <h3 class="roboto-extra-big yellow text-center">¿Hablamos?</h3>
        </div>
    </section>
    
    <section>
        <div class="container">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h1 class="lato-300 dark-grey text-center">Conocenos un poco</h1>
            </div>
            <div class="col-md-4 col-xs-12">
                <h4 class="roboto-400 text-center dark-blue">Como trabajamos</h4>
                <p class="roboto-700">Vender nuestros tours no es lo que mas nos importa, lo que de 
                verdad nos importa es consequir que tus clientes repitan contigo, ergo, tu repitas 
                con nosotros. </p>
            </div>
            <div class="col-md-4 col-xs-12">
                <h4 class="roboto-400 text-center dark-blue">Cuanto vas ha pagar</h4>
                <p class="roboto-700">Hacemos lo imposible para consequir los mejores 
                    precios en alojamientos, transportes y comida para tus clientes. ¿Te han ofrecido mejor 
                    precio en otra parte? No pasa nada, tomamos una cerveza y tan amigos .</p>
            </div>
            <div class="col-md-4 col-xs-12">
                <h4 class="roboto-400 text-center dark-blue">Claro como el agua</h4>
                <p class="roboto-700">¿Te gustan las cosas claras? Tambien a nosostros. Antes de pagar 
                    nada sabras en que has invertido el dinero, sin letra pequeña. Te detallaremos el 
                    tour elegido paso a paso, para que no haya ninguna duda.</p> 
            </div>
        </div>
    </section>

    <section class="oferts-container">
        <div class="container">
            <div class="col-md-12 col-lg-12 col-xs-12">
                <div class="row">
                    <h1 class="lato-300 text-center white">Que hemos hecho ultimamente</h1>
                </div>
                @foreach($tours as $tour)
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="tour-row">
                            <a href="{{ url('tour/'.$tour->id) }}">
                                <img class="img-tour" alt="{{ ucfirst($tour->titulo) }}"
                                    src="{{ asset('admin/images/'.$tour->foto) }}" /> 
                            </a>
                            <div class="tour-info">
                                <div class="row">
                                    <div class="col-md-6 col-xs-6 text-center">
                                        <h3 class="roboto-700 blue price">
                                            <strong>{{ $tour->getTourPrice($tour->precio) }}</strong>
                                        </h3>
                                    </div>                                    
                                    <div class="col-md-12 col-xs-12">
                                        <h4 class="roboto-400 dark-grey">
                                                {{ ucfirst($tour->titulo) }}
                                            </a>
                                        </h4>
                                        <p class="small roboto">
                                            <i class="fa fa-calendar-check-o"></i>
                                            {{ $tour->start . ' al '. $tour->fin }}
                                        </small></p>
                                    </div>                                        
                                    
                                </div>
                            </div>
                        </div>                       
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="oferts-container">
        <div class="container">
            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="row">
                    <h1 class="lato-300 text-center white">Nuestras ultimas ofertas en hoteles </h1>
                </div>
                @foreach($ofertas as $oferta)
                    <div class="col-md-4 col-sm-6 col-xs-12">  
                        <div class="tour-row">
                            <a href="#">                  
                                <img alt="$tour->titulo" class="img-tour"
                                     src="{{ asset('admin/images/'.$oferta->foto) }}" />
                            </a>
                            <div class="tour-info">
                                <div class="row">
                                    <div class="col-md-6 col-xs-6 text-center">
                                        <h3 class="roboto-700 blue" style="margin: -50px 0px 0px 0px;
                                        padding-left: 10px; background-color: #ffffff">
                                            {{ $oferta->getOferPrice($oferta->precio_publico,$oferta->precio_agencias) }} 
                                        </h3>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <h4 class="roboto-400 dark-grey">
                                            {{ ucfirst($oferta->titulo) }}
                                        </h4>
                                        <p class="small roboto">
                                            <i class="fa fa-calendar-check-o"></i>
                                            {{ $oferta->start . " al ".$oferta->fin }}
                                        </p>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>                                            
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    
@stop

@section('customjs')
<script src="{{ asset('/js/jquery.imgFitter.js') }}"></script>
<script type="text/javascript">

    /*
    |---------- RESIZE IMAGENES RESULTADOS BUSQUEDA -----------|
    */
    $(function() {
        $(".img-tor").imgFitter();
    });
</script>
@endsection