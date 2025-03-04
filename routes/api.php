<?php

use Illuminate\Http\Request;

/*
 * ---------------------------------------------------------------------------------
 * UNAUTHORISED API ROUTES
 * ---------------------------------------------------------------------------------
 */
//  Route::post('register', 'UserController@register');
//  Route::post('login', 'UserController@authenticate');
//  Route::get('test/open', 'BookController@testOpen');


 /*
  * ---------------------------------------------------------------------------------
  * AUTHORISED API ROUTES
  * ---------------------------------------------------------------------------------
  */
 Route::group([
   'middleware' => ['jwt.auth'],
 ], function () {
 });
