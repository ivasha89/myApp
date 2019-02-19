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
use БСШСА\Slb;

Auth::routes();
Route::get('/', 'IndexController@index');

Route::get('/signup', 'InterController@signup');

Route::get('/login', 'InterController@login');

Route::get('/table', function () {
    return view('layouts.table');
});

Route::get('/week', function () {
    return view('layouts.week');
});
Route::post('/welcome', function() {
    БСШСА\Slb::create(request(['stts', 'slba', 'idbr', 'date']));
    return redirect('/welcome');
});
Route::get('/welcome', function() {
   $slbs = БСШСА\Slb::all();
   return view('layouts.header', compact('slbs'));
});