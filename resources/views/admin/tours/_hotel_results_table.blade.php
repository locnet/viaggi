                {{-- este fragmento muestra un listado simple con los hoteles disponibles en un destino, 
                se inyecta mediante jquery en el modal _hotel_modal --}}
                    <table class="table table-striped" id="resultTable">
                        <?php foreach($hotel->getNodes('CATALOGUE',false) as $hotelData)
                             $hotelNumber = $hotelData['count']
                        ?>
                        @if ($hotelNumber > 0)
                            <tbody>
                                @foreach($hotel->getNodes('CATALOGUE','BUILDING') as $hotelData)
                                
                                    <tr>
                                        <td>
                                            {{ $hotelData['name'] }}
                                        </td>
                                        <td>
                                            {{ $hotelData['category_name'] }}
                                        </td>
                                        <td>
                                            {{ $hotelData['id'] }}
                                        </td>
                                        <td>
                                            <button class="btn btn-primary" data-id="{{ $hotelData['id'] }}" data-dismiss="modal"
                                                    data-titulo="{{ $hotelData['name'] }}" 
                                                    onclick='setHotel( "{{ $hotelData['id'] }}" , "{{ $hotelData['name'] }}" )'>
                                                    Seleccionar
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @else 
                            <tr>
                                <td><h3 class="lato-300 text-center orange" id="errorText">
                                    No hay hoteles en la zona</h3>
                                </td>
                            </tr>
                        @endif 
                    </table>
                        
                        
                   
                