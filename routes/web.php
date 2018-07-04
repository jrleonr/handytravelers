<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Auth::routes();
//Auth
Route::post('/logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);
Route::get('facebook', ['as' => 'login.facebook', 'uses' => 'LoginController@redirectToFacebook']);
Route::get('facebookCallback', ['as' => 'login.facebookCallback', 'uses' => 'LoginController@handleFacebookCallback']);

Route::get('/', ['as' => 'home', 'uses' => 'LandingController@getIndex']);
Route::get('/privacy-terms', ['as' => 'privacyTerms', 'uses' => 'LandingController@getPrivacyTerms']);
Route::get('/about', ['as' => 'about', 'uses' => 'LandingController@getAboutUs']);
Route::get('how-it-works', ['as' => 'how-it-works', 'uses' => 'LandingController@getHowItWorks']);
//Landings
Route::get('/traveler/{user}', ['as' => 'profile', 'uses' => 'LandingController@profile']);
Route::get('/search', ['as' => 'search', 'uses' => 'SearchController@show']);

//invitation
Route::get('/request/new', ['as' => 'request.form', 'uses' => 'RequestController@showRequestForm']);
Route::post('/request/new', ['as' => 'request.form', 'uses' => 'RequestController@postRequestForm']);
Route::get('/request/sent', ['as' => 'request.sent', 'uses' => 'RequestController@getRequestSent']);
Route::get('/createCustomer/{requestId}', ['as' => 'request.showCreateCustomer', 'uses' => 'RequestController@showCreateCustomer']);
Route::post('/createCustomer', ['as' => 'request.postCreateCustomer', 'uses' => 'RequestController@postCreateCustomer']);
Route::get('/inbox', ['as' => 'inbox', 'uses' => 'RequestController@inbox']);
Route::post('/request/invite', ['as' => 'request.invite', 'uses' => 'RequestController@sendInvite']);
Route::get('/request/{hash}', ['as' => 'request.show', 'uses' => 'RequestController@getShowRequest']);
Route::get('/invitation/{id}', ['as' => 'invitation.show', 'uses' => 'RequestController@show']);
Route::post('/invitation/create', ['as' => 'invitation.create', 'uses' => 'RequestController@postNewConversation']);
Route::post('/invitation/add/message', ['as' => 'invitation.addMessage', 'uses' => 'RequestController@postNewMessage']);

//Edit
Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'LandingController@dashboard']);
Route::get('/edit/completed', ['as' => 'edit.completed', 'uses' => 'EditController@completed']);
Route::get('/edit/profile', ['as' => 'edit.profile', 'uses' => 'EditController@getProfile']);
Route::post('/edit/profile', ['as' => 'edit.profile', 'uses' => 'EditController@postProfile']);
Route::get('/edit/home', ['as' => 'edit.home', 'uses' => 'EditController@getHome']);
Route::post('/edit/home', ['as' => 'edit.home', 'uses' => 'EditController@postHome']);
Route::get('/edit/housemates', ['as' => 'edit.housemates', 'uses' => 'EditController@getHousemates']);
Route::post('/edit/housemates', ['as' => 'edit.housemates', 'uses' => 'EditController@postHousemates']);
Route::get('/edit/photos', ['as' => 'edit.photos', 'uses' => 'EditController@getPhotos']);
Route::post('/edit/photos', ['as' => 'edit.photos', 'uses' => 'EditController@postUpload']);
Route::put('/edit/photos', ['as' => 'edit.photos', 'uses' => 'EditController@editPhotos']);
Route::delete('/edit/photos', ['as' => 'edit.photos', 'uses' => 'EditController@deletePhotos']);
Route::get('/edit/payment', ['as' => 'edit.payment', 'uses' => 'EditController@getPayment']);
