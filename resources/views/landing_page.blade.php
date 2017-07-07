@extends('master')
@section('title','Visita Andalucia con nuestros mejores tours | ')
@section('inicio','class="active"')
@section('content')

    <section>  
        <div class="full-page-container">
            <h3 class="lato-extra-big yellow text-center">Nosotros conocemos Andalucia</h3>
            <h3 class="roboto-extra-big yellow text-center">¿Y tu?</h3>
        </div>
    </section>
    <section class="oferts-container">
        <div class="container">
            <div class="col-md-12 col-lg-12 col-xs-12">
                <div class="row">
                    <h1 class="lato-300 text-center dark-blue">Nuestras ultimas creaciones</h1>
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
    <section>
        <div class="container">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h1 class="lato-300 dark-grey text-center">Porque escogernos</h1>
            </div>
            <div class="col-md-4 col-xs-12">
                <h4 class="roboto-400 text-center dark-blue">SATISFACCION GARANTIZATA</h4>
                <p class="roboto-700">Tu satisfacion es nuestra prioridad y nuestra 
                    mejor satisfacion es que nuestro clientes repitan. Si no estas 
                    satisfecho le devolvemos el dinero sin mas preguntas.</p>
            </div>
            <div class="col-md-4 col-xs-12">
                <h4 class="roboto-400 text-center dark-blue">EL MEJOR PRECIO GARANTIZADO</h4>
                <p class="roboto-700">Intentamos hacer lo imposible para consequir los mejores 
                    precios en alojamientos, transportes y comida. Si encuentra un 
                    tour similar a un mejor precio mejoramos nuestra oferta.</p>
            </div>
            <div class="col-md-4 col-xs-12">
                <h4 class="roboto-400 text-center dark-blue">ATENCION AL CLIENTE PREMIUM</h4>
                <p class="roboto-700"><strong>24/7</strong> Estamos a disposicion de nuestros clientes 24 horas 
                    al dia los siete dias de la semana. Nuestros clientes son el activo mas 
                    preciado de nuestra empresa, por eso te ofrecemos toda nuestra atencion.
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