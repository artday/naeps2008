<?php

/**
 *  Authenticates routes
 */
Auth::routes();

/**
 *  Guest Index Route
 */
Route::get('/', function (){return view('index')->with('user', request()->user());})->name('index');

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
 *  Profile routes
 */
Route::get('/profile/update', 'ProfileController@getUpdate')->name('profile.update');
Route::post('/profile/update', 'ProfileController@postUpdate');

Route::get('/profile/{user?}', 'ProfileController@index')->name('profile');
Route::get('/people', 'ProfileController@people')->name('people');

/**
 *  Events routes
 */
Route::get('/events', 'EventController@index')->name('events');
Route::get('/event/{event}', 'EventController@event')->name('event');
Route::get('/event/{event}/participate', 'EventController@participate')->name('event.participate');
Route::get('/event/{event}/leave', 'EventController@leaveEvent')->name('event.leave');