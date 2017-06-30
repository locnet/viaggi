
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
    /*
    |-------------------------------------------------------|
    |              PAGINACION RESULTADOS BUSQUEDA           |
    |-------------------------------------------------------|
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
        // vaciamos el numero de las paginas y lo recreeamos
        // segun el numero de resultados filtrados
        $('.pagination').empty();
        if (filtered_pages > 1) {
            for (var i = 0; i < filtered_pages;i++) {
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
        

        $('.pagination li').each(function(index){
            $(this).removeClass("active");
            $('.page_' + active_page).addClass('active');
        });

        $('#price-slider-min').text(lowest + " €");
        $('#price-slider-max').text(higest + " €");

        if ($('#priceSlider').val() == "") {
            $('#price-slider-val').text(higest + ' €');
        } else {
            $('#price-slider-val').text($('#priceSlider').val() +" €");
        }
        var step = (Math.round((higest-lowest) / 20) < 1) ? 1 : Math.round((higest-lowest) / 20); 
        $('#priceSlider').attr('data-slider-max',higest + 1);
        $('#priceSlider').attr('data-slider-min',lowest);
        $('#priceSlider').attr('data-slider-step',step);
    }    
    /*
    |------------------------------------------------------|
    | Cosas a ejecutar cuando la pagina ha terminado de    |
    | cargar: slider categoria, slider precio       |
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

        // slider categoria
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
        'hotelObj["hotel_'.$h.'"] = {categoria : ' .$category . ',
                              precio : "' .$procent->makeHotelPrice(
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
        onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        if (ev.date.valueOf() > checkout.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout.setValue(newDate);
          }
          checkin.hide();
          $('#salida')[0].focus();
    }).data('datepicker');
    var checkout = $('#salida').datepicker({
        format: 'yyyy-mm-dd',
        onRender: function(date) {
            return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
        }
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