                {{-- este fragmento muestra un listado simple con los hoteles disponibles en un destino, 
                se inyecta mediante jquery en el modal del view ver-zonas.blade.php --}}
                
                <table class="table table-striped table-bordered" id="resultTable">
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
                                    <a href="{{ url('/admin/ver/hotel/'.$hotelData['id']) }}">
                                        <button class="btn btn-primary">
                                                Ver
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    @else 
                        <tr>
                            <td><h3 class="lato-300 text-center orange" id="errorText">No hay hoteles en la zona</h3></td>
                        </tr>
                    @endif 
                    
                </table>
                