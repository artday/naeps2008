<?php

/**
 *  Authenticates routes
 */
Auth::routes();

/**
 *  Guest Index Route
 */
Route::get('/', function (){return view('index');})->name('index');

/**
 *  Account Activation routes
 */
Route::get('/auth/activate', 'Auth\ActivationController@activate')->name('auth.activate');
Route::get('/auth/activate/resend', 'Auth\ActivationResendController@showResendForm')->name('auth.activate.resend');
Route::post('/auth/activate/resend', 'Auth\ActivationResendController@resend');

/**
 *  Feed routes
 */
Route::get('/feed', 'HomeController@index')->name('feed');

/**
 *  Events routes
 */
Route::get('/events', 'EventController@index')->name('events');
Route::get('/event/{eventId}', 'EventController@event')->name('event');
Route::get('/event/participate/{eventId}', 'EventController@participate')->name('event.participate');