<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Socialite;

class SocialLogin extends Controller
{

    public function __construct(Socialite $socialite){
       $this->socialite = $socialite;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function facebook(){
        return Socialite::driver('facebook')->redirect();
    }


    public function facebook_callback()
    {
       if($user = Socialite::driver('facebook')->user()){
             dd($user);
          }else{
             return 'something went wrong';
          }
    }

    public function google(){
        return Socialite::driver('google')->redirect();
    }


    public function google_callback()
    {
       if($user = Socialite::driver('google')->user()){
             dd($user);
          }else{
             return 'something went wrong';
          }
    }
}
