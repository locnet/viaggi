<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Zonas;
use App\Destinos;
use App\Lib\XmlConector;
use App\Lib\XmlParser;
use Response;

class ZonasController extends Controller
{
    private $zonas;
    private $destinos;
    private $xmlConector;

    function __construct(XmlConector $xmlConector, Zonas $zonas, Destinos $destinos) {
        $this->zonas = $zonas;
        $this->xmlConector = $xmlConector;
        $this->destinos = $destinos;
    }

    /**
    * Devuelve las zonas pertenecientes a un destino que estan activas en la base de datos
    * @param int $id, id destino
    */
    public function getZones($id) {
        $allZones = $this->getAllZones($id);
        $zonas = $this->zonas->where('IdDestino',$id)->get();
        $destino = $this->destinos->find($id);
        return view('admin.zonas.ver-zonas',compact('zonas','destino','allZones'));
    }
    /**
     * Devuelve todas las zonas pertenecientes a un destino, esten o no en la base de datos
     *
     * @param int $id
     */
    private function getAllZones($id) 
    {
        try{
            $xml = new XmlConector();
            $xml->servicio = "101";
           
            // parametros de la llamada
            
            $xml->parametros = $id;
            //dd($xml->parametros);
            $zones = new XmlParser($xml->getString()); 
            // dd($destinations);                      // debug
            return $zones;      

        } catch(Exception $e) {
            $parserErrors = $e->getMessage();
            dd($parserErrors);
            exit();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function create()
    {

    }

    /**
     * Crea una entrada nueva en la tabla 'zonas'
     *
     * @param int $zoneId, id zona
     * @param string $zoneName, nombre zona
     * @param int $destinoId, id destino
     */
    public function store($destinoId, $zoneId, $zoneName)
    {
        $query = ['IdZona'    => $zoneId,
                'NombreZona' => $zoneName,
                'IdDestino'  => $destinoId];

        if ($this->zonas->firstOrCreate($query)) {
            return "true";
        }
    }

    /**
     * Borra una entrada de la table 'zonas'
     *
     * @param int $zoneId, id zona
     */
    public function destroy($id)
    {
        $zone = $this->zonas->find($id);
        if ($zone) {
            $zone->delete();
            return "true";
        } 
        return "false";
    }
}
