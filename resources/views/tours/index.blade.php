@extends('master')
@section('title','Visita Andalucia con nuestros mejores tours | ')
@section('inicio','class="active"')
@section('content')

    <section  class="hidden-xs">  
        <div id="mainCarousel" class="container carousel slide" data-ride="carousel">
            
            <!-- container para los sliders -->
            <div class="carousel-inner">
                <div class="item active">     
                    <img src="{{ asset('images/slider1.jpg') }}" class="img-responsive" 
                         alt="pueblo andaluz blanco" />       
                    <div class="carousel-caption">
                      <h2 class="roboto">Andalucia es beleza</h2>
                      <p>Pueblos blancos con calles estrechas, flores colgando en las paredes.</p>
                    </div>
                </div><!-- /item -->

                <div class="item">
                  <img src="{{ asset('images/slider2.jpg') }}" alt="mapa Andalucia" />
                  <div class="carousel-caption">
                    <h2>Andalucia es cultura</h2>
                    <p>El flamenco, la Semana Santa, el rocio....
                  </div>
                </div><!-- /item -->

                <div class="item">
                  <img src="{{ asset('images/slider3.jpg') }}" alt="casa en Toscana" />
                  <div class="carousel-caption">
                    <h2>Andalucia es sol y playa</h2>
                    <p>Playas de arena blanca con sol brillante todo el año.</p>
                  </div>
                </div><!-- /item -->
            </div>
            <a class="left carousel-control hidden-xs" href="#mainCarousel" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control hidden-xs" href="#mainCarousel" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div>
    </section>  
    <section>
        <div class="container">
            <h1 class="lato text-center blue">
               Somos Andalusiando Viaggi 
            </h1>
        <h4>Nos dedicamos a enseñar Andalucia a los que no la conocen. 
      </div>
    </section>
    <section class="tours-container">
        <div class="container">
            <div class="col-md-12 col-lg-12 col-xs-12">
                <div class="row">
                    <h2 class="roboto blue">Nuestros ultimos tours</h2>
                </div>
                @foreach($tours as $tour)
                    <div class="col-md-3 col-xs-6">
                        <div class="tour-row">
                            <img class="img-responsive" 
                                 src="http://192.168.1.37/viaggi/toursuploads/images/{{ $tour->foto }}" /> 
                            <div class="tour-info">
                                <p class="small roboto">
                                    <i class="fa fa-calendar-check-o"></i>
                                    {{ $tour->start . ' al '. $tour->fin }}
                                </p>
                                <h4>
                                    <a href="{{ url('tour',$tour->idtour) }}">
                                        {{ ucfirst($tour->titulo) }}
                                    </a>
                                </h4>
                                <h4 class="roboto">Precio: {{ $tour->getTourPrice($tour->precio) }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
          </div>
        </section>
        <section class="oferts-container">
          <div class="container">
            <div class="col-md-12 col-lg-12 col-xs-12">
                <div class="row">
                    <h2 class="roboto text-center">Nuestras ultimas ofertas en hoteles </h2>
                </div>
                @foreach($ofertas as $oferta)
                    <div class="col-md-4 col-sm-6 col-xs-6">  
                        <div class="tour-row">
                            <a href="" alt="$tour->tituloOfertas" class="img-responsive">                  
                                <img src="http://localhost/viaggi/uploads/images/{{ $oferta->fotoOfertas }}" 
                                class="img-responsive" />
                            </a>
                            <div class="tour-info">
                                <p class="small roboto">
                                    <i class="fa fa-calendar-check-o"></i>
                                    {{ $oferta->start . " al ".$oferta->fin }}
                                </p>
                                <h4><a href="">{{ ucfirst($oferta->tituloOfertas) }}</h4>
                                <h4 class="roboto">Precio: 
                                    {{ $oferta->getOferPrice($oferta->precioPublico,$oferta->precioOfertas) }} 
                                </h4>
                            </div>
                        </div>                                            
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@stop