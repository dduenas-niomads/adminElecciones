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

Route::get('/', function () {
    // return view('welcome');
    return redirect('/login');
});

Route::resource('customers', 'CustomerController');
Route::resource('admins', 'AdminController');
Route::resource('positions', 'PositionController');
Route::resource('areas', 'AreaController');
Route::resource('voters', 'VoterController');
Route::resource('nominees', 'NomineeController');
Route::resource('elections', 'ElectionController');

Route::resource('results', 'ResultController');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Account
Route::get('/my-account', 'Account\AccountController@myAccount')->name('my-account');
Route::put('/my-account', 'Account\AccountController@updateMyAccount')->name('update-my-account');
Route::post('/my-account/logout-all', 'Account\AccountController@logoutAll')->name('logout-all');
