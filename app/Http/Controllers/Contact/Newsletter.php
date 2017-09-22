<?php

namespace App\Http\Controllers\Contact;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Newsletters;
use Mail;
class Newsletter extends Controller
{
    /**
    * modelos necesarios
    */
    private $newsletters;

    function __construct(Newsletters $newsletters) 
    {
        $this->newsletters = $newsletters;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('contact.newsletter');
        
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
        $validate = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email'
            ]);
        
        $token = str_random(16);
        $newsletter = $this->newsletters->where('email', $request->email)->first();

        // si el email no existe en la base de datos procedemos a crear una entrada
        if ($newsletter ===  null) {
            $query = array('email'      => $request->email,
                           'name'       => $request->name,
                           'token'      => $token,
                           'visitor_ip' => $_SERVER['REMOTE_ADDR']);

            // creamos entrada en la base de datos
            if ( $n =  Newsletters::firstOrCreate($query) ) {
                // send the confirmacion email
                $mail = $n->email;

                $this->sendConfirmacionMail($mail);
                
                return view('contact.newsletter_confirm')->withMessage("new");
            } else {
                return view('contact.newsletters_confirm')->withMessage("error");
            }
        } else {
            return view('contact.newsletter_confirm')->withMessage('exist');
        }
    }

    /**
    * Send the confirmacion email
    * 
    */
    private function sendConfirmacionMail($mail) 
    {
        Mail::raw('Text to e-mail', function($message)
        {
            $message->from('us@example.com', 'Laravel');

            $message->to("locnetarganda@gmail.com");
        });
    }


    /** 
    * Remove a resource from database
    * @param $email, el email a borrar
    * @param $token, el token para comprobar la autenticidad de la peticion
    */
    public function destroy($email, $token)
    {
        if (strlen($token) === 16 && filter_var( $email, FILTER_VALIDATE_EMAIL )) {
            $user = $this->newsletters->where('email',$email)
                                      ->where('token',$token)
                                      ->first();
            if (count($user) === 1) {
                if ($user->delete()) {
                    return view('contact.newsletter_confirm')->withMessage('deleted');
                }
            } else {
                return view('contact.newsletter_confirm')->withMessage('no_user');
            }
        } 
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

   
}
