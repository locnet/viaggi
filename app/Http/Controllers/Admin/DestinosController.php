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

class DestinosController extends Controller
{
    private $xmlConector;
    private $destinos;

    function __construct(XmlConector $xmlConector,
                         Destinos $destinos)
    {
        $this->xmlConector = $xmlConector;
        $this->destinos = $destinos;
    }

    /**
     * Listado de todos los destinos disponibles en Andalusiando Viaggi
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destinos = $this->destinos->all()->sortBy('NombreDestino');
        return view('admin.destinos.index-destinos',compact('destinos'));
    }

    /**
    * Vista de los destinos disponibles en Sidetour
    */
    public function viewAllDestinations() 
    {
        // destinos Andaluciando
        $destViaggi = $this->destinos->get();
        // destinos Sidetours
        $destSide = $this->getAllDestinations();
        return view('admin.destinos.sidetour-destinos',compact('destSide','destViaggi'));
    }

    /**
     * Devuelve un listado de los destinos disponibles en Sidetours
     *
     * @return \Illuminate\Http\Response
     */
    private function getAllDestinations()
    {
        try{
            $xml = new XmlConector();
            $xml->servicio = "100";
           
            // parametros de la llamada
            
            $xml->parametros = "1";
            //dd($xml->parametros);
            $destinations = new XmlParser($xml->getString()); 
            // dd($destinations);                      // debug
            return $destinations;      

        } catch(Exception $e) {
            $parserErrors = $e->getMessage();
            dd($parserErrors);
            exit();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, $name)
    {     

        if ($this->destinos->firstOrCreate(['IdDestino' => $id, 'NombreDestino' => $name])) {
            return "true";
        }
    }

  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->destinos->find($id)) {
            $this->destinos->find($id)->delete();
            return "deleted";
        }
    }
}
