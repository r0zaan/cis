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
    return view('master');
});

Route::resource('/provinces','Province\ProvinceController');


Route::resource('/districts','District\DistrictController');

Route::resource('/municipalities','Municipality\MunicipalityController');

Route::post('/municipalities/province/','Municipality\MunicipalityController@districtData');
