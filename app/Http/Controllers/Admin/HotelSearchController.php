<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Destinos;
use App\Zonas;
use App\Lib\XmlConector;
use App\Lib\XmlParser;
use Session;
use Input;
use Response;

class HotelSearchController extends Controller
{
    /**
    *  modelos y datos de sesion necesarios
    */
    private $tour;
    private $destinos;
    private $zonas;
    private $xmlConector;

    function __construct(XmlConector $xmlConector,
                         Destinos $destinos, Zonas $zonas)
    {
        $this->xmlConector = $xmlConector;
        $this->destinos = $destinos;
        $this->zonas = $zonas;
    }



    /**
     * Display the hotel search form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $destinos = $this->destinos->lists('NombreDestino','IdDestino')->sort();
        $zonas = $this->zonas->lists('NombreZona','IdZona');
        $idZonas = $this->zonas->all();
        return view('hotel.search',compact('destinos','zonas','idZonas'));
    }

    /**
    * devuelve un listado simple de los hoteles disponibles en el destino y la zona escogidos
    * devuelve una vista o otra dependiendo del ultimo parametro de la ruta
    * 
    */
    public function getHotelsModal($d, $z, $action) {
        // cadena xml
        $hotel = $this->getZoneHotels($d, $z);

        // comprobamos si no tenems errores
        if ($hotel->hasError()){            
            return view('hotel.search_error',compact('hotel'));
        } else {
            // captamos la vista y la devolvemos
            if ($action === 'edit') {
                $v = view('admin.tours._hotel_results_table',compact('hotel'));
            } else {    
                $v = view('admin.tours._zone_hotel_table', compact('hotel'));
            }
            return $v;
            
        }     
    }
    
    /**
    * devuelve un listado simple de hoteles de una zona en concreto
    */
    /**
    * devuelve una cadena xml con los hoteles pertenecientes a un destino 
    * @param $d, destino a buscar
    * @param $z, zona del destino a buscar
    */
    private function getZoneHotels($d, $z) {
        
        try{
            $xml = new XmlConector();
            $xml->servicio = "202";
            // zona
            $zona = " ";
            if ($z !== 0) {
                $zona = ' zone="'.$z.'" ';
            }
            // parametros de la llamada
            $param = '<PARAMETERS language="2" destination="'.$d.'" '.
                      $zona .' pay_mode="A"></PARAMETERS>';
            //dd($param);                        // debug
            $xml->parametros = $param;
            //dd($xml->parametros);
            $hotelXml = new xmlParser($xml->getString()); 
            //dd($hotelXml);                      // debug
            return $hotelXml;          

        } catch(Exception $e) {
            $parserErrors = $e->getMessage();
            dd($parserErrors);
            exit();
        }
    }

    /**
    * develve los detalles de un hotel en concreto
    * @param id el id del hotel deseado
    */

    public function getHotelDetails($id) {
        $parserNodes = array();
        if($id){
            // conecto con el servicio hoteles
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
        return view('admin.zonas.ver-hotel',compact('hotel','parserNodes'));
    }
}
