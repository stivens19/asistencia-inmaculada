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
    return view('welcome');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);
Route::group(['middleware' => 'roles:Auxiliar,Master'], function () {
    Route::resource('days','AttendanceController');
    Route::get('days/info-user/{id}','AttendanceController@infoUser')->name('info-user');
    Route::post('days/registrar-asistencia/{user}/{attendance}','AttendanceController@registrarAsistencia')->name('registrar-asistencia');
    Route::get('excelview/{attendance}','AttendanceController@exportView')->name('excelview');
    Route::post('excel-asistencia/{attendance}','AttendanceController@export')->name('excel-asistencia');
    Route::view('/subirus', 'users.import')->name('subirus');
    Route::post('subir-usuarios','UserController@import')->name('subir-usuarios');
});
Route::group(['middleware' => 'roles:Master'], function () {
    Route::resource('/users', 'UserController');
});

Route::get('/home', 'HomeController@index')->name('home');
