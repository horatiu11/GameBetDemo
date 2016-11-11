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

Route::get('/' , 'MainController@viewPage')->name('welcomePage');

//Authentication routes----------------------------------------
Route::post('/login' , 'MainController@login')->name('login');

Route::get('/logout' , 'MainController@logout')->name('logout');
//-------------------------------------------------------------

Route::group(['middleware' => ['auth']], function () {
	//Challenge routes---------------------------------------------
	Route::get('/challenge', 'ChallengeController@viewPage')->name('challengePage');

	Route::get('/challenge/enter', 'ChallengeController@joinChallenge')->name('challengeEnter');
	//-------------------------------------------------------------

	//Wait routes---------------------------------------------
	Route::get('/wait', 'ChallengeController@viewWait')->name('waitPage');

	Route::get('/wait/outcome', 'ChallengeController@postOutcome')->name('challengeOutcome');
	//-------------------------------------------------------------	
});