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

Route::get('/', 'IndexController@index');
Route::get('/signup', 'InterController@signup');
Route::post('/signup', 'InterController@registration');
Route::get('/check', 'InterController@signup');
Route::post('/check', 'InterController@check');
Route::get('/login', 'InterController@login')->name('login');
Route::post('/login', 'InterController@enter');
Route::get('/logout', 'InterController@logout')->name('logout');

Route::get('/slbs', 'SlbsController@index');
Route::post('/slbs', 'SlbsController@store');
Route::get('/slbs/statistic','SlbsController@statistics');
Route::get('/{user}', 'IndexController@user')->middleware('auth');
Route::get('/{user}/projects', 'ProjectsController@index')->middleware('auth');
Route::resource('/projects', 'ProjectsController')->except('index');
Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
Route::patch('/tasks/{task}', 'ProjectTasksController@update');



/*
Route::post('/welcome', function() {
    Slb::create(request(['stts', 'slba', 'user_id', 'date']));
    return redirect('/welcome');
});
Route::get('/welcome', function() {
   $slbs = Slb::all();
   return view('layouts.header', compact('slbs'));
});*/
