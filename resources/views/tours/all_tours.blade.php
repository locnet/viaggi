@extends('master')
@section('title','Tours de Andalucia guiados | Tours  de Andalucia con guia italiano')
@section('tours','class="active"')
@section('content')
    <section class="tours-container">
        <div class="container">
            <div class="row">
                <h1 class="lato-300 text-center white">Tenemos para tu agencia unos tours espectaculares</h1>
            </div>
        	@foreach($tours as $tour)	        	
                <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="tour-row">
                            <a href="{{ url('tour',$tour->id) }}">
                                <img class="img-tour" alt="{{ ucfirst($tour->titulo) }}"
                                    src="{{ asset('/admin/images/'. $tour->foto) }}" /> 
                                </a>
                            <div class="tour-info">
                                <div class="row">
                                    <div class="col-md-8 col-xs-8">
                                        <h4 class="roboto-400 dark-grey">
                                                {{ str_limit(ucfirst($tour->titulo), 19) }}
                                            </a>
                                        </h4>
                                        <p class="small roboto">
                                            <i class="fa fa-calendar-check-o"></i>
                                            {{ $tour->start . ' al '. $tour->fin }}
                                        </small></p>
                                    </div>
                                    <div class="col-md-4">
                                        <h3 class="dark-blue">
                                            <strong>{{ $tour->getTourPrice($tour->precio) }}</strong>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                    </div>         
            @endforeach
        </div>
    </section>
@endsection

@section('customjs')
<script src="{{ asset('/js/jquery.imgFitter.js') }}"></script>
<script type="text/javacript">
    /*
    |---------- RESIZE IMAGENES RESULTADOS BUSQUEDA -----------|
    */
    $(function() {
        $(".img-tour").imgFitter(
            backgroundPosition: 'center center');
    });
</script>
@endsection
    