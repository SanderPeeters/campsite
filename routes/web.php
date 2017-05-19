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

Route::get(trans('routes.home'), ['as' => 'home', 'uses' => 'HomeController@index']);

Route::get(trans('routes.offer-campsite'), function() {
    return view('campsite.campsite-offer');
})->name('offer-campsite');

Route::get('lang/{language}', 'LanguageController@switchLang')->name('lang.switch');
