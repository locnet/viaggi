<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '1712819608961994',
        'client_secret' => 'b577c369f7663c49229b021f99cd4ded',
        'redirect' => 'http://localhost/viaggi-responsive/public/index.php/facebook/callback',
        ],
    /*
    * la autentificacion de google cuesta un poco mas hacerla funcionar
    * si no funciona prueba habilitar las api: autentificacion, Google + y Contacts
    * si todavia no funciona prueba borrar la clave secreta y regenerarla
    */
    'google' => [
        'client_id' => '869506146301-c3drid8rtso1alracjattuid0s6euumr.apps.googleusercontent.com',
        'client_secret' => 'vvfW9_Qby-XnUhq_KuwIoCAl',
        'redirect' => 'http://localhost/viaggi-responsive/public/index.php/google/callback',
    ],
];
