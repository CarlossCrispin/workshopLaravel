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


Route::get('/', function () {
    return view('welcome');
});

Route::get('/usuarios', 'UserController@index');
/* prioridad en el orden de la declaración de rutas  */
Route::get('/usuarios/{user}', 'UserController@show')
    ->where('user', '[0-9]+')
    ->name('users.show');

Route::get('/usuarios/nuevo', 'UserController@create');

Route::post('/usuarios/crear', 'UserController@store');

Route::get('/usuarios/{user}/edit', 'UserController@edit'); 

Route::put('/usuarios/{user}', 'UserController@update'); 

Route::delete('/usuarios/{user}', 'UserController@destroy'); 

Route::get('/saludos/{name}/{nickname?}', 'WelcomeUserController');


