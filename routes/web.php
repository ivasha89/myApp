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
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Slb;
use App\Http\Controllers\InterController;


Route::get('/', 'IndexController@index');
Route::get('/signup', 'InterController@signup');
Route::post('/signup', 'InterController@registration');
Route::get('/check', 'InterController@signup');
Route::post('/check', 'InterController@check');
Route::get('/login', 'InterController@login')->name('login');
Route::post('/login', 'InterController@enter');
Route::get('/logout', 'InterController@logout')->name('logout');

Route::get('/slbs', 'SlbsController@index')->middleware('auth');
Route::post('/slbs', 'SlbsController@store');
Route::get('/slbs/statistic','SlbsController@statistics')->middleware('auth');

/*Route::get('/table', function () {
    return view('layouts.table');
});

Route::get('/week', function () {
    return view('layouts.week');
});
Route::post('/welcome', function() {
    Slb::create(request(['stts', 'slba', 'user_id', 'date']));
    return redirect('/welcome');
});
Route::get('/welcome', function() {
   $slbs = Slb::all();
   return view('layouts.header', compact('slbs'));
});*/
//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
