<?php

namespace App\Http\Controllers\Hotel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Exceptions\Handler;
use App\Procentajes;
use App\Lib\XmlConector;
use App\Lib\XmlParser;
use Session;
use Input;
use Carbon\Carbon;
use App\Reservas;

Carbon::setLocale('es');


class PdfController extends Controller
{
    private $xmlConector;
    private $procentajes;
    private $reservas;

    function __construct(XmlConector $xmlConector,Procentajes $procentajes,
                         Reservas $reservas)
    {
        $this->xmlConector = $xmlConector;
        $this->procentajes = $procentajes;
        $this->reservas = $reservas;
    }


    /**
     * Si no existe crea la factura de la reserva, si existe la recupera
     *
     * @param int $locata
     */
    public function viewPdf($locata) {
        // detalles reserva en nuestra base de datos
        $reserva = $this->reservas->where('locata',$locata)->first();

        $factura = 'factura-'.$locata.'.pdf';
        $filename = base_path('public/admin/facturas/'.$factura);

        if (file_exists($filename)) {
            // tenemos ya la factura creada
            return \Response::make(file_get_contents($filename), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$factura.'"']);            
            
        } else {
            // creamos la factura
            $pdfFile = $this->createInvoicePdf($locata);
            if (!$pdfFile) {
                return view('orders.error')
                    ->withMessage("Error! No se ha podido generar la factura, intentalo otra vez");
            }
            return $pdfFile;
        }
    }

    /**
     * Crea el pdf de la factura despues del pago de la reserva
     *
     * @param int $locata
     */
    public function createInvoicePdf($locata) {
        $reserva = $this->reservas->where('locata',$locata)->first();
        try {
            // detalles reserva en Sidetours
            $xml = new XmlConector();
            $xml->servicio = "502";
            $param =  '<PARAMETERS locata="'.$locata.'" language="2" />';
            $xml->parametros = $param;
            $booking = new XmlParser($xml->getString());
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

                if ($booking != null  && $hotel != null && $reserva != null) {
                    // creamos y guardamos el pdf de la reserva
                    $file = base_path('public/admin/facturas/factura-'.$locata.'.pdf');

                    $pdf_file =  \PDF::loadView('hotel.view_pdf',compact('booking','hotel','reserva','locata'))
                                        ->save($file);

                    return "true";
                } else {
                    return "false";
                }
            }
        }
        catch(Exception $e) {
            $bookingError = $e->getMessage();
            return false;
        }
    }
}
