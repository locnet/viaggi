<?php

namespace App\Http\Controllers\Tours;

use Illuminate\Http\Request;
use App\Exceptions\Handler;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tour;
use App\Destinos;
use App\Zonas;
use App\Procentajes;
use App\Lib\XmlConector;
use App\Lib\XmlParser;
use Session;
use Input;
use App\Lib\CustomClasses\GetBuildingCategory;


class HotelController extends Controller
{


    /**
    *  modelos y datos de sesion necesarios
    */
    private $tour;
    private $destinos;
    private $zonas;
    private $procentajes;
    private $xmlConector;

    function __construct(Tour $tour, XmlConector $xmlConector,
                         Destinos $destinos, Zonas $zonas,
                         Procentajes $procentajes)
    {
        $this->tour = $tour;
        $this->xmlConector = $xmlConector;
        $this->destinos = $destinos;
        $this->zonas = $zonas;
        $this->procentajes = $procentajes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tourid, $id)
    {        
        $data = ($this->tour->where('id', '=', $tourid)->first());

        $parserNodes = array();
        if($id){
            //conecto con el servicio hoteles
            $xml = new xmlConector();
            $xml->servicio = "200";
            $parserNodes['nod'] = "BUILDING";
            $parserNodes['subnod'] = false;
            $hotel = array();//hago un array para pasar los hoteles
            
            try{
                $xml->parametros = '<PARAMETERS language="2" building_id="'.$id.'"></PARAMETERS>';
                $result = $xml->getString();//esto me devuelve un string XML
                //print_r(htmlspecialchars($result));//solo para debugging
                //inicializo la clase que me procesa el string xml
                $hotel[] = new xmlParser($xml->getString());
                // dd($hotel);
                //ahora tengo en el array $hotel las cadenas xml de cada hotel implicado en el tour
             }
             catch(Exception $e){
                 echo $e->getMessage();
                 exit();
             }                        
        }
        return view('tours.hotel',compact('data','hotel','parserNodes'));
    }

    /**
     * Display the hotel search form.
     *
     * @return \Illuminate\Http\Response
     */
    public function search() 
    {
        $destinos = $this->destinos->lists('NombreDestino','IdDestino')->sort();
        $zonas = $this->zonas->lists('NombreZona','IdZona');
        $idZonas = $this->zonas->all();
        return view('hotel.search',compact('destinos','zonas','idZonas'));
    }

    /**
     * Proces the hotel search form.
     *
     * @return \Illuminate\Http\Response
     */
    public function postSearch(Request $request) 
    {
        /*
        *  flasheamos los datos de la primera busqueda
        */
        Input::flashExcept('zona');
        $destinos = $this->destinos->lists('NombreDestino','IdDestino')->sort();
        $zonas = $this->zonas->lists('NombreZona','IdZona');
        $idZonas = $this->zonas->all();

        $validate = $this->validate($request, [
            'destino' => 'required',
            'entrada' => 'required|date_format:Y-m-d',
            'salida' => 'required|date_format:Y-m-d',
            'adult_in_room_1' => 'digits_between: 1,4'
            ]);
        // numero habitaciones
        $rooms = $request->input('roomsNumber');

        /** habitaciones, adultos, niños y edades niños
        *   a mandar al HotelBooking
        */
        $bookingParameters = "";
        try{
            $xml = new XmlConector();
            $xml->servicio = "1400";
            // zona
            $zona = " ";
            if ($request->input('zona') !== 0) {
              $zona = ' zone="'.$request->input('zona').'" ';
            }
            // parametros de la llamada
            $param = '<PARAMETERS language="2" 
                      destination="'. $request->input('destino').'" '.
                      $zona .'
                      check_in="'.$request->input('entrada').'" 
                      check_out="'.$request->input('salida').'" 
                      tourism_type="" pay_mode="A" filter="PR">';

            for ($i = 1; $i < $rooms + 1; $i++) {
                $adults = $request->input('adult_in_room_'.$i);
                $childs = $request->input('child_in_room_' . $i);

                $param .= '<ROOM adults="'.$adults.'" children="'.$childs.'" ';
                $bookingParameters .= '<ROOM adults="'.$adults.'" children="'.$childs.'" ';
                if ($childs > 0){
                    for ($x = 0; $x < $childs; $x++) {
                        $param .= 'age'.$x.'="'.$request->input('room_'.$i.'_age_'.$x).'" ';
                        $bookingParameters .= 'age'.$x.'="'
                                              .$request->input('room_'.$i.'_age_'.$x).'" ';
                    }                    
                }  
                $param .= ' idmv="1" />'; 
                $bookingParameters .= ' idmv="1" />';   
            }
            $param .= ' </PARAMETERS>'; // fin parametros

            //dd($param);
            $xml->parametros = $param;
            //dd($xml->parametros);
            $hotel = new xmlParser($xml->getString()); 
            // dd($hotel);
            // procentaje agencia sobre el precio del hotel          
            $procent = $this->procentajes->first();

            /* necesitamos mandar los parametros de la busqueda del hotel hacia el 
            *  el controller HotelBooking, para esto paso los datos al view result.blade.php
            *  en result.blade.php llamamos el controller HotelBooking
            */
            if ($hotel->hasError()){
                return view('hotel.search_error',compact('hotel'));
            } else {
                // make view
                return view('hotel.result',compact('hotel','procent','destinos',
                                      'zonas','idZonas','bookingParameters'));
            }            

        } catch(Exception $e) {
            $parserErrors = $e->getMessage();
            dd($parserErrors);
            exit();
        }
    }    
}
