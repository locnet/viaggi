<?php

/* RUTAS PARA TESTING */
Route::get('test','Test@hotel_category');
Route::get('landing','Landing@index');

/*
|--------------------------------------------------------------|
| RUTAS DE INICIO Y TOURS                                      |
|--------------------------------------------------------------|
*/
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::get('tour/{tourid}/hotel/{id}','Tours\HotelController@index');
Route::get('tour/all','Tours\ViewTourController@index');
Route::get('tour/{id}','Tours\ViewTourController@show');
Route::get('tour','HomeController@index');
//Route::post('tour', 'Tours\CreateTourController@store');

/*
|----------------------------------------------------------------|
| BUSQUEDA HOTELES                                               |
|----------------------------------------------------------------|
*/
Route::get('hotel/search','Hotel\HotelController@search');
Route::get('hotel/{ any }', 'Hotel\HotelController@search');
Route::get('hotel','Hotel\HotelController@search');
Route::post('hotel/search','Hotel\HotelController@postSearch');

/*
|----------------------------------------------------------------|
| BOOKING HOTELES                                                |
|----------------------------------------------------------------|
*/
Route::post('hotel/book','Hotel\BookingController@index');
Route::post('hotel/reservar','Hotel\BookingController@startBooking');
Route::post('hotel/confirmar','Hotel\BookingController@confirmPaxData');
Route::post('hotel/pagar','Hotel\BookingController@makeBooking');
Route::get('hotel/ver/reserva/{locata?}','Hotel\BookingController@getBooking');
Route::get('hotel/ver/pdf/{locata}','Hotel\PdfController@viewPdf');
Route::get('hotel/descargar/pdf{locata}','Hotel\PdfController@downloadPdf');

/*
|----------------------------------------------------------------
| CONTACTO
|----------------------------------------------------------------
*/
Route::get('contact','Contact\ContactController@index');
Route::get('newsletter','Contact\Newsletter@index');
Route::post('newsletter/store','Contact\Newsletter@store');
Route::get('newsletter/destroy/{email}/{token}', 'Contact\Newsletter@destroy');

/*
|----------------------------------------------------------------
| AUTENTIFICATION & REGISTRO
|----------------------------------------------------------------
*/
Route::get('auth', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Reset password...
Route::get('password/reset', 'Auth\PasswordController@getEmail');
Route::post('password/reset', 'Auth\PasswordController@postEmail');

// Social login..
Route::get('login/facebook', 'Auth\SocialLogin@facebook');
Route::get('facebook/callback', 'Auth\SocialLogin@facebook_callback');

Route::get('login/google', 'Auth\SocialLogin@google');
Route::get('google/callback','Auth\SocialLogin@google_callback');
/*
|-----------------------------------------------------------------
| ADMINISTRACION
|-----------------------------------------------------------------
*/
Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function() {
	Route::get('/admin','Admin\MainController@index');
	// Tours
	Route::get('/admin/tours','Admin\CreateTourController@index');

	Route::get('/admin/tours/nuevo','Admin\CreateTourController@stepOne');

    Route::post('/admin/tours/intermedio','Admin\CreateTourController@intermedio');

	Route::get('/admin/tours/paso-dos', 'Admin\CreateTourController@stepTwo');    

	Route::resource('/admin/tours/guardar','Admin\CreateTourController@store');

	Route::post('/admin/tours/crear','Admin\CreateTourController@create');

	Route::get('/admin/tours/editar/{id}','Admin\CreateTourController@edit');

	Route::post('/admin/tours/update/{id}','Admin\CreateTourController@update');

	Route::get('/admin/tours/borrar/{id}', 'Admin\CreateTourController@destroy');

    // utilizo la misma ruta para servir dos view diferentes
	Route::get('/ver/hoteles/{destino}/{zona}/{action}','Admin\HotelSearchController@getHotelsModal');

	// Destinos
	Route::get('/admin/destinos','Admin\DestinosController@index');
	Route::get('/admin/ver/hotel/{id}','Admin\HotelSearchController@getHotelDetails');
	Route::get('/admin/destinos/todos','Admin\DestinosController@viewAllDestinations');
	Route::get('/admin/destinos/nuevo/{id}/{destino}','Admin\DestinosController@store');
	Route::get('/admin/destinos/borrar/{id}', 'Admin\DestinosController@destroy');

	// Zonas 
	Route::get('/admin/zonas','Admin\ZonasController@index');
    Route::get('/admin/destino/{id}/zonas', 'Admin\ZonasController@getZones');
    Route::get('/admin/zonas/nueva/{iddestino}/{idzona}/{nombrezona}', 'Admin\ZonasController@store');
    Route::get('/admin/zonas/borrar/{id}', 'Admin\ZonasController@destroy');
    
	// Procentajes
	Route::get('/admin/procentajes','Admin\ProcentController@index');
	Route::post('/admin/procentajes/editar/{id}','Admin\ProcentController@update');

	// Ofertas
	Route::get('/admin/ofertas','Admin\OfertasController@index');
	Route::get('/admin/ofertas/nueva','Admin\OfertasController@create');
	Route::post('/admin/ofertas/guardar','Admin\OfertasController@store');
	Route::get('/admin/ofertas/borrar/{id}','Admin\OfertasController@destroy');
	Route::get('/admin/ofertas/editar/{id}','Admin\OfertasController@edit');
	Route::post('/admin/ofertas/update/{id}','Admin\OfertasController@update');

	// Agencias
	Route::get('/admin/agencias','Admin\AgenciasController@index');
	Route::get('/admin/agencia/{id}','Admin\AgenciasController@show');
});
