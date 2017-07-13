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
      
        if ($user) {
            Mail::send('mails.welcome_mail', ['user' => $user], function($message)
            {
                $message->to('locnetarganda@gmail.com', 'John Smith')->subject('Confirmacion registro Andalusiando Viaggi');
            });

            return view('auth.success_message', compact('user'));
        } else {
            return view('errors.user_error')->withMessage('Ha ocurido un error inesperado, por favor 
                vuelve al correo electronico y intentalo otra vez. Si el error persiste mandanos un 
                email al info@andalsiandoviaggi.com.');
        }
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
            $message = "Esta cuenta ya esta activada, no tienes que hacer nada mas.";
        }
        return view('auth.register_message')->with('message',$message);
    }

    /**
    * Confirmacion borrado agencia
    *
    * @param string $confirmation_code
    * @param string $email
    */
    public function unsuscribe($confirmation_code, $email) 
    {
        $user = User::where('confirmation_code','=',$confirmation_code)
                        ->where('email','=',$email)->first();
        
        if ($user) {
            return view('auth.confirm_unsuscribe', compact('user'));
        } else {
            return view('errors.user_error')->withMessage('El usuario no existe en la base de datos.');
        }
        
    }

    /**
    * Borrar agencia
    *
    * @param int $id
    */

    public function deleteAgency($id, $confirmation_code) 
    {
        $user = User::where('confirmation_code',$confirmation_code)->where('id',$id)->first();

        
        if ($user) {
            $user->delete();             
        } else {
            return view('errors.user_error')->withMessage('No hemos podido borrar tu cuenta porque 
                este usuario no existe en nuestra base de datos.');
        }
        
    }
}
