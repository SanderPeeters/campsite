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

Route::get('/', 'Campsite\CampsiteController@index')->name('welcome');

Auth::routes();

Route::get(trans('routes.home'), ['as' => 'home', 'uses' => 'HomeController@index']);

Route::get(trans('routes.search-campsite'), 'Search\SearchController@index')->name('search-campsite');
Route::get('/campsite/search', 'Search\SearchController@searchCampsites');

Route::get(trans('routes.offer-campsite'), 'Campsite\CampsiteController@indexOfferCampsite')->name('offer-campsite');

Route::get('/campsite/offers', 'Campsite\CampsiteController@getAllCampsites');

Route::get('lang/{language}', 'LanguageController@switchLang')->name('lang.switch');

//    Only logged in users can access these routes else redirected to '/'
Route::group(['middleware' => 'auth'], function()
{

    Route::get(trans('routes.offer-campsite-new'), function() { return view('campsite.offer.campsite-offer-new'); })->name('offer-campsite.new');
    Route::post('/campsite-offer/store', 'Campsite\CampsiteController@storeCampsite');
    Route::post('/campsite-offer/images/store', 'Campsite\ImageController@saveImage');

});