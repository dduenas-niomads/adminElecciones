<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/loaderio-739a304a77f7f70ee98c2c2b1b175fcb', function() {
    return "loaderio-739a304a77f7f70ee98c2c2b1b175fcb";
})->name('loader-io');

Route::get('/voter-login', function () {
    return view('voters.login');
})->name('voter-login');

Route::get('/', function () {
    return redirect('/login');
});

Route::resource('positions', 'Admin\PositionController');
Route::resource('areas', 'Admin\AreaController');
Route::resource('voters', 'Admin\VoterController');
Route::resource('nominees', 'Admin\NomineeController');
Route::resource('elections', 'Admin\ElectionController');

Route::resource('results', 'Admin\ResultController');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/detail', [App\Http\Controllers\HomeController::class, 'detail'])->name('detail');

// Account
Route::get('/my-account', 'Account\AccountController@myAccount')->name('my-account');
Route::put('/my-account', 'Account\AccountController@updateMyAccount')->name('update-my-account');
Route::post('/my-account/logout-all', 'Account\AccountController@logoutAll')->name('logout-all');

Route::post('/voter-login-post', 'Voters\VoterController@postLoginVoter')->name('voter-login-post');
Route::post('/voter-validate-info', 'Voters\VoterController@postInfoVoter')->name('voter-validate-info');
Route::post('/voter-submit-vote', 'Voters\VoterController@submitVote')->name('voter-submit-vote');
Route::post('/voter-thanks-for-vote', 'Voters\VoterController@postThanksforVote')->name('voter-thanks-for-vote');