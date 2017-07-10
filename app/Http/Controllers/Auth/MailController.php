<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
    /**
     * Confirmacion del registro nueva agencia.
     *
     * @param  string  $confirmation_code
     * 
     * @return \Illuminate\Http\Response
     */
    public function sendConfirmation($confirmation_code) 
    {
        $user = User::where('confirmation_code','=', $confirmation_code)->first();
        return view('mails.welcome_mail',compact('user'));
        Mail::send('mails.welcome_mail', ['user' => $user], function($message)
        {
            $message->to('locnetarganda@gmail.com', 'John Smith')->subject('Welcome!');
        });
    }
     
     public function getConfirmation($confirmation_code) 
     {
        if ($user = User::where('confirmation_code','=', $confirmation_code)->first() ) {
            $user->status = 1;
            $user->save();
        }
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
