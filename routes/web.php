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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['namespace'=>'Update', 'prefix'=>'update'], function(){
  Route::post('startingShift', 'StartingShift')->name('update.startingShift');
  Route::post('startingDate', 'StartingDate')->name('update.startingDate');
  Route::post('durationOfShiftInDays', 'DurationOfShift')->name('update.durationOfShiftInDays');
  Route::post('freeDays', 'FreeDays')->name('update.freeDays');
});

Route::post('checkShift', 'CheckShift');
Route::post('setLocale', 'SetLocale');


Route::get('/{any?}', 'MainAppController')
->name('homepage')
->where('any', '.*');
