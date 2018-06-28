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

Auth::routes();

Route::get('facebook', ['as' => 'login.facebook', 'uses' => 'LoginController@redirectToFacebook']);
Route::get('facebookCallback', ['as' => 'login.facebookCallback', 'uses' => 'LoginController@handleFacebookCallback']);
Route::get('/', ['as' => 'home', 'uses' => 'LandingController@getIndex']);
Route::get('/privacy-terms', ['as' => 'privacyTerms', 'uses' => 'LandingController@getPrivacyTerms']);
Route::get('/about', ['as' => 'about', 'uses' => 'LandingController@getAboutUs']);
Route::get('how-it-works', ['as' => 'how-it-works', 'uses' => 'LandingController@getHowItWorks']);

