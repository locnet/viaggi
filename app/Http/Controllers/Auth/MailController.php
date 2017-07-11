<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;

class MailController extends Controller
{
    /**
     * Mandar el email con las instrucciones para confirmar el registro.
     *
     * @param  string  $confirmation_code
     * 
     * @return \Illuminate\Http\Response
     */
    public function sendConfirmation($confirmation_code) 
    {
        $user = User::where('confirmation_code','=', $confirmation_code)->first();
      

        Mail::send('mails.welcome_mail', ['user' => $user], function($message)
        {
            $message->to('locnetarganda@gmail.com', 'John Smith')->subject('Welcome!');
        });
        return view('auth.success_message', compact('user'));
    }

    /**
     * Confirmacion del registro nueva agencia.
     *
     * @param  string  $confirmation_code
     * 
     * @return \Illuminate\Http\Response
     */
     
     public function getConfirmation($confirmation_code) 
     {
        $user = User::where('confirmation_code','=', $confirmation_code)->first();

        if ( $user->status === 0) {      // el registro no esta confirmado
            
            $user->status = 1;
            $user->save();
            $message = "Gracias, la cuenta ha sido activada corectamente.";
        } else {
            $message = "Esta cuenta esta activa, no es necesario activarla de nuevo.";
        }
        return view('auth.register_message')->with('message',$message);
     }
    
}
