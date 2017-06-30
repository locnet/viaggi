@extends('master')
@section('title','Hoteles baratos en Andalucia | Los precios mas baratos en hoteles en la costa')
@section('meta_description','En Andalusiandoviaggi.com te damos los precios mas baratos en la 
reserva de hotel en Andalucia.')
@section('hotel','class="active"')
@section('customcss')
    <link rel="stylesheet" href="{{ asset('datepicker/css/datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-slider.css') }}">
@endsection
@section('preloader')
<div class="se-pre-con"></div>
@stop
@section('content')
<div class="container search-small-form">
    <div class="row" id="search-form">
        <div class="col-md-12 col-xs-12">
            <h4>
                <span class="fa fa-close hidden-lg hidden-md pull-right" 
                      id="search-menu-close"></span>
            </h4>
        </div>
         {!! Form::open(['url' => '/hotel/search',null,'class' => 'form-horizontal']) !!}
            {!! csrf_field() !!}
            <div class="col-md-12 col-xs-12">   
           
                <div class="col-md-4 col-xs-6">
                    <div class="form-group{{ $errors->has('destino') ? ' has-error' : '' }}">
                        <div class="col-md-4 control-label">
                            {!! Form::label('destino','Destino') !!}
                        </div>
                        <div class="col-md-8">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-map-marker"></span>
                                </div> 
                                {!! Form::select('destino',
                                                  $destinos,
                                                  old('destinos'), 
                                                  ['class' => 'form-control',
                                                   'id' =>'destino',
                                                   'onchange' => 'setZones()']) 
                                !!} 
                            </div>
                            @if ($errors->has('destino'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('destino') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>                        
                </div>
           
                <!-- right side -->
                <div class="col-md-3 col-xs-6">
                    <div class="form-group{{ $errors->has('entrada') ? ' has-error' : '' }}">
                        <div class="col-md-4 control-label">
                            {!! Form::label('entrada','Entrada') !!}
                        </div>  
                        <div class="col-md-8">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </div> 
                                {!! Form::input('text','entrada',null,
                                               ['class' => 'form-control',
                                                'id' => 'entrada',
                                                'readonly']) !!}                                
                             </div>
                            @if ($errors->has('entrada'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('entrada') }}</strong>
                                </span>
                            @endif                           
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="form-group{{ $errors->has('salida') ? ' has-error' : '' }}">
                        <div class="col-md-4 control-label">
                            {!! Form::label('salida','Salida') !!}
                        </div>

                        <div class="col-md-8">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </div> 
                                {!! Form::input('text','salida',null,
                                               ['class' => 'form-control', 
                                                'id' => 'salida',
                                                'readonly']) !!}
                             </div>
                            @if ($errors->has('salida'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('salida') }}</strong>
                                </span>
                            @endif                           
                        </div>
                    </div>
                </div>
                {!! Form::hidden('zona',0) !!}
                {!! Form::hidden('roomsNumber') !!}
                @if ($rooms = Form::old('roomsNumber') ?: 1) @endif
                @for ($i=1; $i <= $rooms;$i++)
                    {!! Form::hidden('adult_in_room_'.$i) !!}
                    {!! Form::hidden('child_in_room_'.$i, 0) !!}
                    {!! Form::hidden('room_'.$i.'_age_0', 0) !!}
                    {!! Form::hidden('room_'.$i.'_age_1', 0) !!}
                @endfor
                <div class="col-md-2 col-xs-12 control-label">
                    <a href="{{ url('hotel/search') }}">
                        <button type="input" class="btn btn-primary">
                            Busca
                        </button>
                    </a>
                </div>
            </div>
        {!! Form::close() !!}  
    </div> 
</div>
<div class="container search-results-bg"> 
    <div class="col-12">
        <?php $results = 0; ?>
        @foreach ($hotel->getNodes('BUILDING_SET',false) as $h)
            {{-- numero de hoteles encontrados --}}
            @if ($results = $h['count'] ?: 0) @endif
        @endforeach
    </div>  
    <div class="row"> 
        <h4 class="text-center blue">
            <span class="fa fa-search hidden-lg hidden-md" id="search-button"></span>
            <span class="fa fa-filter hidden-lg hidden-md" id="filter-button"></span>
            {{ $results }} hoteles encontrados
        </h4>
        <div class="col-md-3 col-xs-12" id="filter-menu">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="roboto"><span class="fa fa-filter"></span>Filtros</h3>
                </div>
                <div class="panel-body">
                    <p>
                        <span class="fa fa-close hidden-lg hidden-md pull-right" 
                                  id="filter-menu-close"></span>
                    </p>
                    <p id="stars-count" class="white roboto">Estrellas: 
                        <span class="fa fa-star"></span>
                    </p>
                    <input id="starSlider"  type="text" data-slider-min="1"
                           data-slider-max="5" data-slider-step="1" 
                           data-slider-value="1"  />  
                </div>
                <div class="panel-body">
                    <p class="roboto white">Precio maximo: 
                        <strong><span id="price-slider-val" class="blue"></span></strong>
                    </p>
                    <p class="roboto white">
                        <span id="price-slider-min" class="small roboto pull-left" ></span>
                        <span id="price-slider-max" class="small roboto pull-right"></span>
                    </p>
                    <input id="priceSlider" type="text"  data-slider-min="1"
                           data-slider-max="5" data-slider-step="5" 
                           data-slider-value="1" /> 
                </div>
            </div>            
           
        </div>
        <div class="col-md-9 col-xs-12 ">   
            <?php 
                $h = 1; 
                $getBuilding = new \App\Lib\CustomClasses\GetBuildingCategory;
            ?>            
            @foreach($hotel->getNodes('BUILDING_SET','BUILDING') as $hotelData)
                <?php 
                    $category = substr($hotelData['category_name'], 0,1);
                    $type = intval($hotelData['type']);
                    if ($category > 0 ){
                        $stars = $category;
                    } else {
                        $stars = 1;
                    }                            
                ?>
                <div class="col-md-12 col-xs-12 search-movil-container" id="hotel_{{ $h }}">      
                    <div class="col-md-3 col-xs-4">
                        <!-- saco solo la primera foto del hotel -->
                            <img data-src="{{ url($hotelData['photo_url']) }}" 
                                class="img-hotel img-responsive" width="180" height="130" />                               
                    </div>
                    <div class="col-md-9 col-xs-8">
                        <div class="col-md-12 col-xs-12 pull-down">
                            <h4 class="lato-200 dark-blue">
                                {{ $getBuilding::getType($type)." " }}
                                <strong>
                                    {{ $hotelData['name'] }}
                                </strong>
                            </h4>   
                        </div> 
                                           
                        <div class="col-md-12 col-xs-12 pull-down">
                            
                            <p class="small stars_{{ $stars }}">                                
                                @for($i = 0; $i<$stars;$i++)
                                    @if ($hotelData['type'] > 5 &&   $hotelData['type'] < 11)
                                        <span class="fa fa-key"></span>
                                    @else
                                        <span class="fa fa-star"></span>
                                    @endif
                                @endfor
                            
                                <span class="fa fa-map-marker"></span>
                                     {{ $hotelData['zone_name'] }}
                            </p>
                        </div>
                        <div class="col-md-12 pull-down">
                            <div class="col-md-7 col-xs-7">                            
                                <h4 class="lato-200 text-primary"><strong>
                                    {{ $procent->makeHotelPrice(
                                            $procent,
                                            $hotelData->BOARD['pvp_type'],
                                            $hotelData->BOARD->ROOM['min_price'],
                                            $hotelData->BOARD->ROOM['min_price_pvp'])
                                    }} €
                                </strong></h4>
                            </div>
                            <div class="col-md-5 col-xs-5">
                            {!! Form::open(['url' => '/hotel/book',null]) !!} 
                                {{-- pagina activa, filtro precio, filtro categoria --}}
                                {!! Form::hidden('activePage') !!} 
                                {!! Form::hidden('activeCategory',1) !!}
                                {!! Form::hidden('activePrice',10000) !!}

                                {!! Form::hidden('roomsNumber') !!}                             
                                {!! Form::hidden('bookingParamters',$bookingParameters) !!}                                
                                {!! Form::hidden('destino') !!}
                                {!! Form::hidden('hotelId',$hotelData['id']) !!}
                                {!! Form::hidden('zona') !!}
                                {!! Form::hidden('entrada') !!}
                                {!! Form::hidden('salida') !!}
                                @if ($rooms = Form::old('roomsNumber') ?: 1) @endif
                                @for ($i=1; $i <= $rooms;$i++)
                                    {!! Form::hidden('adult_in_room_'.$i) !!}
                                    {!! Form::hidden('child_in_room_'.$i, 0) !!}
                                    {!! Form::hidden('room_'.$i.'_age_0', 0) !!}
                                    {!! Form::hidden('room_'.$i.'_age_1', 0) !!}
                                @endfor
                                <button type="submit" class="btn btn-success pull-right">
                                    <span class="small">Ver mas</span>
                                </button>  
                            {!! Form::close() !!}                             
                            </div>
                        </div>
                    </div>             
                </div>   
                <?php  $h++; ?>
            @endforeach
            
            <nav>
                <ul class="pagination">
                    @if ($results > 10)                    
                        @for ($i = 0; $i < (ceil($results / 10) + 1); $i++) 
                            <li  class="page_{{$i}}" 
                                 onclick="paginateHotel({{ $i }},
                                                       $('starSlider').val(),
                                                       $('priceSlider').val())">
                                 <a href="#">{{ $i + 1}}</a>
                            </li>
                        @endfor
                    @endif
                </ul>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            
        </div>
    </div>
</div>
@endsection

@section('customjs')
<script src="{{ asset('/js/jquery.imgFitter.js') }}"></script>
<script src="{{ asset('/js/bootstrap-slider.js') }}"></script>
<script src="{{ asset('datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

<script type="text/javascript">
    // Esperar que carga la pagina
    $(window).load(function() {
        // animacion
        $(".se-pre-con").fadeOut("slow");;
    });
    /*
    |---------- RESIZE IMAGENES RESULTADOS BUSQUEDA -----------|
    */
    $(function() {
        $(".img-hotel").imgFitter();
    });

    // show / hide div filter-menu y search-form
    $('#filter-button, #filter-menu-close').click(function(){
        if($('#filter-menu').css('display') === 'none') {
             $('#filter-menu').show(300);
         } else {
             $('#filter-menu').hide(300);
         }
       
    });
    $('#search-button, #search-menu-close').click(function(){
        if ($('#search-form').css('display') === 'none') {
            $('#search-form').show(300);
        } else {
            $('#search-form').hide(300);
        }
    });
    /**
    |-------------------------------------------------------|
    |              PAGINACION RESULTADOS BUSQUEDA           |
    |                                                       |
    |@param active_page, pagina actual                      |
    |@param stars, categoria del hotel                      |
    |@param price, precio minimo encontrado en cada hotel   |
    |-------------------------------------------------------|
    */
    function paginateHotel(active_page, stars, price){

        var h = 1;
        var start = active_page * 10;
        var stop = start + 10;
        var i = 1;
        var lowest = 1000;
        var higest = 1;        
        // actualizez nr pagini actuale
        $('input[name=activePage]').val(active_page);

        $('.search-movil-container').each(function(){
            var hotel_stars = hotelObj['hotel_' + h].categoria;
            var hotel_price = Math.round(hotelObj['hotel_' + h]
                                        .precio.toString().replace(',',''));

            // precio mas bajo y mas alto
            if (hotel_price < lowest) {
                lowest = hotel_price;
            }
            if (hotel_price > higest) {
                higest = hotel_price;
            }

            if (hotel_stars >= stars && hotel_price <= price){
                if (i > start && i <= stop) {
                    $('#hotel_'+h).show(300);
                } else {
                    $('#hotel_'+h).hide(300);
                }
                i++;
            } else {
                $('#hotel_' + h).hide(300);
            }
            h++;            
        });
        /*--------------paginacion resultatos ----------------*/

        var  filtered_pages = Math.ceil( (i - 1) / 10);

        // boramos y recreamos el menu de paginacion
        // segun el numero de resultados filtrados
        $('.pagination').empty();

        if (filtered_pages > 1) {
            for (var i = 0; i < filtered_pages; i++) {
                var l = $('<li/>',{
                    class : "page_" + i
                });
                var a = $('<a/>', {
                    href: '#',
                    html: i + 1,
                    onclick: "paginateHotel(" + i + ",$('#starSlider').val(),$('#priceSlider').val())"
                })
                l.append(a);
                $('.pagination').append(l);
            }
        }
        
        // el index de la pagina activa
        $('.pagination li').each(function(index){
            $(this).removeClass("active");
            $('.page_' + active_page).addClass('active');
        });

        $('#price-slider-min').text(lowest + " €");
        $('#price-slider-max').text(higest + " €");

        if ($('#priceSlider').val() == "") {
            $('#price-slider-val').text(higest + ' €');
        } else {
            $('#price-slider-val').text($('#priceSlider').val() + ' €');
        }

        // calculamos el valor de cada salto del slider
        var step = (Math.round((higest-lowest) / 20) < 1) ? 1 : Math.round((higest-lowest) / 20); 
        $('#priceSlider').attr('data-slider-max',higest + 1);
        $('#priceSlider').attr('data-slider-min',lowest);
        $('#priceSlider').attr('data-slider-step',step);
    }    
    /*
    |------------------------------------------------------|
    | Cosas a ejecutar cuando la pagina ha terminado de    |
    | cargar: slider categoria, slider precio              |
    |------------------------------------------------------|
    */
    $(document).ready(function(){
        //pagina activa
        var a = ($('input[name=activePage]').val() === "") ? 0 : $('input[name=activePage]').val();

        // filtro precio maximo
        var b = $('input[name=activePrice]');
        var c = $('#priceSlider');
        var maxPrice = 0;

        if (b.val() != $('#priceSlider').val()) {
            maxPrice = parseInt(b.val());
        } else {
            maxPrice = parseInt($('#priceSlider').attr('data-slider-max'));
        }
        // paginamos los resultados
        paginateHotel(a, 1, maxPrice);
        $('#price-slider-val').text(maxPrice + " €");

        // slider precio
        $('#priceSlider').slider({
            formatter: function(value) {
                return value;
            },
            value: maxPrice
        }).on('change', function(v){
                // paginamos filtrando por el precio
                paginateHotel(0, $('#starSlider').val(), $('#priceSlider').val());
                
                $('#price-slider-val').text($('#priceSlider').val() + " €");
                // actualizamos el valor del precio maximo a filtrar
                $('input[name=activePrice]').val($('#priceSlider').val());
        });

        // slider categoria hotel
        var v = 1;
        var x = parseInt($('input[name=activeCategory').val());
        if (x > 1) {
            v = x;
        }
        var p = $('#stars-count');
        for (var i = 1; i <= v; i++){
            if (p.find('span').length < v) {
                p.append('<span class="fa fa-star"></span>');
            } else {
                while (p.find('span').length > v) {
                     p.find('span:last-of-type').remove();
                }
            }
        }

        // paginamos los resultados
        paginateHotel(a, v, maxPrice);

        
        $('#starSlider').slider({
            formatter: function(value) {
                return  value;
            },
            value: v
        }).on('change',function(){
            var p = $('#stars-count');
            var v = $(this).val();

            for (var i = 1; i <= v; i++){
                if (p.find('span').length < v) {
                    p.append('<span class="fa fa-star"></span>');
                } else {
                    while (p.find('span').length > v) {
                         p.find('span:last-of-type').remove();
                    }
                }
            }
            // categoria minima
            $('input[name=activeCategory]').val($(this).val());
            // paginamos otra vez filtrando los resultados por la categoria
            paginateHotel(0, $(this).val(), $('#priceSlider').val());
        });
    });

    /*
    |-------------------------------------------------------------|
    |             OBJETO HOTELES                                  |
    | contiene datos de los hoteles encontrados                   |
    |-------------------------------------------------------------|
    */
    var hotelObj = new Object();

    <?php $h = 1; ?>

    @foreach($hotel->getNodes('BUILDING_SET','BUILDING') as $hotelData)
        <?php
            if ($hotelData['type'] == 9) {
                $category = 1;
            } else {
                $category = substr($hotelData['category_name'],0,1) ?: 1;
            }             
        ?>
        
        {!!        
        'hotelObj["hotel_' . $h . '"] = {   categoria : ' .$category . ',
                                        precio : "'.$procent->makeHotelPrice(
                                                    $procent,
                                                    $hotelData->BOARD['pvp_type'],
                                                    $hotelData->BOARD->ROOM['min_price'],
                                                    $hotelData->BOARD->ROOM['min_price_pvp']).'",
                                        zona: "'.$hotelData['zone_name'].'"};'
        !!}

        <?php $h++ ?>
    @endforeach
 
    /*
    |-----------------------------------------------------------|
    |              DATE PICKER                                  |
    |-----------------------------------------------------------|
    */
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

    var checkin = $('#entrada').datepicker({
        format: 'yyyy-mm-dd',
        weekStart: 1,
        language: 'es',
        startDate: now
    }).on('changeDate', function(ev) {
        
        var newDate = new Date(checkin.getDate());
        newDate.setDate(newDate.getDate() + 1);
        checkout.setDate(newDate);
        checkout.setStartDate(new Date(checkin.getDate()));
    
        checkin.hide(); 
        $('#salida')[0].focus();
    }).data('datepicker');
    
    var checkout = $('#salida').datepicker({
        format: 'yyyy-mm-dd',
        weekStart: 1,
        language: 'es'
    }).on('changeDate', function(ev) {
        checkout.hide();
    }).data('datepicker');

    $('.dropdown-menu').on('click',function(){
        this.css('width','100%').css('margin-left',0);
        });
    /*
    |-----------------------------------------------------|
    |          CONFIGUAR ZONAS                            |
    |-----------------------------------------------------|
    */
    // contiene todas las zonas de la base de datos
    var z = {};
    @foreach ($idZonas as $id)
        {!! 
            'z['. $id->IdZona .'] = { nombreZona: "' . $id->NombreZona . 
                                      '", idZona: ' . $id->IdZona .
                                      ', idDestino: ' . $id->IdDestino . '};'                                 
        !!}
    @endforeach
    
    var zona = $("#zona");   //select zonas

    function setZones(){

        var selectedId = $("#destino option:selected").val();  // el destino selectado

        //limpio todas las opciones del select "zona"
        zona.empty().
        append($('<option>',{
            value: 0,
            text: "Todas las zonas"
        }));

        for (var id in z) {
            //añado solo las zonas pertenecientes al destino selectado
            if (z[id].idDestino == selectedId) {
                zona.append($('<option>', {
                    value: z[id].idZona,
                    text: z[id].nombreZona
                }));
            }
        }
    }
    setZones();
</script>
@endsection