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
Route::get('/check', 'InterController@signup');
Route::get('/login', 'InterController@login')->name('login');
Route::get('/logout', 'InterController@logout')->name('logout');
Route::get('/slbs', 'SlbsController@index');
Route::get('/slbs/statistic','SlbsController@statistics');
Route::get('/{user}', 'UserController@index');
Route::get('/{user}/projects', 'UserController@show');
Route::post('/login', 'InterController@enter');
Route::post('/check', 'InterController@check');
Route::post('/signup', 'InterController@registration');
Route::post('/slbs', 'SlbsController@store');
Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
Route::patch('/tasks/{task}', 'ProjectTasksController@update');

Route::resource('/projects', 'ProjectsController')->except('index');



/*
Route::post('/welcome', function() {
    Slb::create(request(['stts', 'slba', 'user_id', 'date']));
    return redirect('/welcome');
});
Route::get('/welcome', function() {
   $slbs = Slb::all();
   return view('layouts.header', compact('slbs'));
});*/
