@extends('master')
@section('title','Circuitos por Andalucia | Viajar por Andalucia con Andalusiando')
@section('inicio','class="active"')
@section('content')

    <section>  
        <div class="full-page-container">
            <div class="col-md-6 col-xs-12" style="background-color: rgba(76, 67, 67, 0.75)">
                <h2 class="lato-300 white text-center bold">A tus clientes les gustaran nuestros circuitos de 
                    Andalucia</h2>
                <h4 class="lato-300 white">Los clientes son el activo mas importante de una empresa, 
                    por esto tienes que ofrecerles siempre la mejor calidad junto al mejor precio.</h4>
                <h4 class="lato-300 white">¿Y tu, les estas ofreciendo los mejores circuitos de Andalucia?</h4>
                <h4 class="text-center">
                    <a href=""><button class="btn btn-default">Saber mas</button></a>
                </h4>
            </div>
        </div>
    </section>
    
    <section>
        <div class="container">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h1 class="lato-300 dark-grey text-center">Conocenos</h1>
            </div>
            <div class="col-md-4 col-xs-12">
                <div class="services-container">
                    <h4 class="roboto-400 text-center">Como trabajamos</h4>
                </div>
                <p class="roboto-700">Vender nuestros tours de Andalucia no es lo que mas nos importa, lo que de 
                verdad nos importa es consequir que tus clientes repitan contigo, ergo, tu repitas 
                con nosotros. </p>
            </div>
            <div class="col-md-4 col-xs-12">
                <div class="services-container">
                    <h4 class="roboto-400 text-center dark-blue">Precios</h4>
                </div>
                <p class="roboto-700">Hacemos lo imposible para consequir los mejores 
                    precios en alojamientos, transportes y comida para tus clientes. ¿Te han ofrecido mejor 
                    precio en otra parte? No pasa nada, tomamos una cerveza y tan amigos .</p>
            </div>
            <div class="col-md-4 col-xs-12">
                <div class="services-container">
                    <h4 class="roboto-400 text-center dark-blue">Claro como el agua</h4>
                </div>
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
                    <h1 class="roboto-400 text-center white">Que hemos hecho ultimamente</h1>
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
                    <h1 class="roboto-400 text-center white">Ofertas en hoteles </h1>
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