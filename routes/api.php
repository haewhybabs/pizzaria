<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('jwt.auth')->get('/user','api\profileController@getuser');
Route::post('login', 'ApiController@login');
Route::post('userregister', 'ApiController@register');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'ApiController@logout');
 
   // Route::get('user', 'ApiController@getAuthUser');
 	
    
});
Route::get('/getpizzacateogry','ApiController@getCate');
Route::get('/getcompany','ApiController@getCom');
Route::middleware('jwt.auth')->get('/getProducts','api\homeController@getProducts');
// Route::get('/getProducts','api\homeController@getProducts');
Route::get('/getPreferencesmeta','ApiController@getPreferencesmeta');
Route::middleware('jwt.auth')->post('/setLocation','api\homeController@setLocation');



Route::post('/password/email', 'api\apiForgotPassword@sendLink');
Route::post('/password/reset', 'api\apiResetPassword@reset_password');
Route::get('/checkdetails','api\profileController@checkdetails')->middleware('jwt.auth');
Route::post('/filldetails','api\profileController@filldetails')->middleware('jwt.auth');
Route::post('/updateprofile','api\profileController@updateprofile')->middleware('jwt.auth');
Route::post('/updatepassword','api\profileController@updatepassword')->middleware('jwt.auth');

Route::get('/getstores/{page}','ApiController@getStores');

Route::post('neareststores','ApiController@nearestStores');
Route::post('searchstore','ApiController@searchStores');
