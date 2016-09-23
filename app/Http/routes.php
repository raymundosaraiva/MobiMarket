<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/newproduct', function () {
    return view('newproduct');
});

Route::get('/logout', function() {
    Session::flush();
    return Redirect::guest("/");
});

Route::get('/', 'BaseController@getIndex');

Route::get('/products', 'BaseController@showProducts'); 

Route::get('/actionslist', 'BaseController@actionsList'); 

Route::get('/action/{cod}', 'BaseController@getProduct');


Route::post('/registerproduct', 'BaseController@registerProduct');

Route::post('/registeruser', 'BaseController@registerUser');

Route::post('/registeraction', 'BaseController@registerAction');

Route::post('/login', 'BaseController@userLogin');

?>