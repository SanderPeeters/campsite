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
Route::get(trans('routes.search-campsite-with-province', ['id']), 'Search\SearchController@searchOnProvince')->name('search-campsite.withprovince');

Route::get(trans('routes.offer-campsite'), 'Campsite\CampsiteController@indexOfferCampsite')->name('offer-campsite');

Route::get('/campsite/offers', 'Campsite\CampsiteController@getAllCampsites');
Route::get(trans('routes.campsite', ['id', 'slug?']), 'Campsite\CampsiteController@showCampsite')->name('campsite.display');

Route::get('/provinces', 'Campsite\CampsiteController@getAllProvinces');
Route::get('/states', 'Campsite\CampsiteController@getAllStates');
Route::get('/movements', 'Movement\MovementController@getAllMovements');

Route::get('lang/{language}', 'LanguageController@switchLang')->name('lang.switch');

//    Only logged in users can access these routes else redirected to '/'
Route::group(['middleware' => 'auth'], function()
{
    Route::post(trans('routes.storereview'), 'Review\ReviewController@storeReview')->name('review.store');
    Route::post('/save-campsite', 'Saving\SavingController@statusSaveCampsite');

    Route::post('/campsite-offer/store', 'Campsite\CampsiteController@storeCampsite');
    Route::post('/campsite-offer/images/store', 'Campsite\ImageController@saveImage');

    Route::get(trans('routes.my-profile'), 'HomeController@myProfile')->name('my-profile');
    Route::post(trans('routes.profile-update'), 'HomeController@updateProfile')->name('profile.update');
    Route::post(trans('routes.password-change'), 'HomeController@changePassword')->name('profile.changepassword');

    Route::get(trans('routes.make-reservation', ['id', 'slug?']), 'Reservation\ReservationController@showReservationForm')->name('reservation.showform');
    Route::post('/make-reservation', 'Reservation\ReservationController@makeReservation')->name('reservation.store');
    Route::get(trans('routes.delete-reservation', ['id']), 'Reservation\ReservationController@deleteReservation')->name('reservation.delete');
    Route::get(trans('routes.accept-reservation', ['id']), 'Reservation\ReservationController@acceptReservation')->name('reservation.accept');

});