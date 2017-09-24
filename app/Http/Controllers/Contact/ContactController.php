<?php

namespace App\Http\Controllers\Contact;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use Config;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact/contact');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendRequest(Request $request)
    {
        $validate = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required|min:10'
            ]);
        
        // mandamos el email
        Mail::send('mails.contact_request', ['contact' => $request], function($message)
        {
            $message->to('locnetarganda@gmail.com', 'Andalusiando Viaggi')
                    ->subject('Solicitud informacion');
        });
        if (count(Mail::failures())  > 0) {

            // si el envio del email falla avisamos al administrator
            Mail::raw('El formulario de contacto no funciona.', function($message)
            {
                $message->from('info@andalusiandoviaggi.com', 'Laravel error');

                $message->to(Config::get('constants.ADMINISTRATOR_EMAIL'));
            });
        }
        // todo ok
        return view('contact.contact_success')->withMessage('ok');
    }   
}
