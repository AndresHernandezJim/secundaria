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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/alumnos/registro','HomeController@registroAlumno');
Route::post('/alumnos/registro','HomeController@registroa');
Route::get('/alumnos/consulta','HomeController@veralumnos');

Route::get('/alumno/buscar1','HomeController@buscaalumnocurp');
Route::get('/alumno/buscar2','HomeController@buscaalumnonombre');
Route::get('/modificar/{id}','HomeController@modif');
Route::get('/eliminar/{id}','HomeController@eliminar');
Route::post('/modificar/alumnos','HomeController@modificar');
Route::get('alumnos/reporte','HomeController@reporte');
Route::get('/alumno/obtener1','HomeController@alumno1');
Route::get('/alumno/obtener2','HomeController@alumno2');
Route::get('/alumno/obtener3','HomeController@alumno3');
Route::post('/reportar/alumno','HomeController@reportaralumno');