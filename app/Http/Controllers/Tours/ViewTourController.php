<?php

namespace App\Http\Controllers\Tours;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tour;
use App\Lib\XmlConector;
use App\Lib\XmlParser;

class ViewTourController extends Controller
{
    /** modelos y datos de sesion necesarios
    *
    */
    private $tour;
    private $xmlConector;

    function __construct(Tour $tour, XmlConector $xmlConector)
    {
        $this->tour = $tour;
        $this->xmlConector = $xmlConector;
    }

    /**
     * Devuelve todos los tours disponibles
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $tours = ($this->tour->all());
        return view('tours.all_tours',compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->tour->find($id);

        $parserNodes = array();
        if($idhotel = explode("&",$data['idhoteles'])){
            //conecto con el servicio hoteles
            $xml = new xmlConector();
            $xml->servicio = "200";
            $parserNodes['nod'] = "BUILDING";
            $parserNodes['subnod'] = false;
            $hotel = array();//hago un array para pasar los hoteles
            foreach($idhotel as $id){//paso por cada hotel
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
        }
        return view('tours.tour',compact('data','hotel','parserNodes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
