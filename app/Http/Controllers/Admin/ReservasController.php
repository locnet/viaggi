<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Reservas;
use App\Lib\XmlConector;
use App\Lib\XmlParser;
use Carbon\Carbon;
use App\Lib\CustomClasses\SpanishDate;

class ReservasController extends Controller
{

    private $reservas;

    public function __construct(Reservas $reservas) 
    {
        $this->reservas = $reservas;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservas = $this->reservas->orderBy('created_at','DESC')->paginate(20);
        return view('admin.reservas.index',compact('reservas'));
    }

    /**
     * Rescatar detalles de una reserva.
     *
     * @param int $locata
     */
    public function getBooking($locata) 
    {
        // detalles reserva en nuestra base de datos
        $reserva = $this->reservas->where('locata',$locata)->first();
        
        try {
            // detalles reserva en Sidetours
            $xml = new XmlConector();
            $xml->servicio = "502";
            $param =  '<PARAMETERS locata="'.$locata.'" language="2" />';
            $xml->parametros = $param;
            $booking = new XmlParser($xml->getString());
            $fecha = SpanishDate::getDayName();
                  
            if ($booking->hasError()){
                return view('hotel.view_booking_error',compact('booking'));
            } else {
                 // detalles hotel
                foreach($booking->getNodes("RESERVATION",false) as $b){
                    $hotelId = $b['building_id'];
                }
                $xml->servicio = "200";
                $param = '<PARAMETERS language="2" building_id="'.$hotelId.'"></PARAMETERS>'; 
                //dd($param);
                $xml->parametros = $param;
                //dd($xml->parametros);
                $hotel = new XmlParser($xml->getString());
                return view('hotel.view_booking',compact('booking','hotel','reserva','locata','fecha'));
            }
        }
        catch(Exception $e) {
            $bookingError = $e->getMessage();
            return false;
        }
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
        //
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
