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
	Route::get('/challenge', 'ChallengeController@viewPage')->middleware('currentUserChallenge')->name('challengePage');

	Route::post('/challenge/create', 'ChallengeController@createChallenge')->middleware('uniqueChallenge')->name('challengeEnter');

	Route::post('/challenge/accept', 'ChallengeController@acceptChallenge')->name('challengeAccept');
	//-------------------------------------------------------------

	//Wait routes---------------------------------------------
	Route::get('/wait', 'ChallengeController@viewWait')->name('waitPage');

	Route::post('/wait/post', 'ChallengeController@postOutcome')->name('challengeOutcome');
	//-------------------------------------------------------------	

	//Outcome routes---------------------------------------------
	Route::get('/outcome', 'ChallengeController@viewOutcome')->name('outcomePage');

	Route::post('/outcome/confirm', 'EvidenceController@evidence')->name('confirm');

	Route::get('/evidence', 'EvidenceController@viewPage')->name('evidencePage');
	Route::post('/evidence/submit', 'EvidenceController@submitEvidence')->name('submit');
	//-------------------------------------------------------------	
});