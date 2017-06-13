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

Route::get(trans('routes.search-campsite'), 'Search\SearchController@index')->name('search-campsite');
Route::get(trans('routes.search-campsites'), 'Search\SearchController@searchCampsites');
Route::get(trans('routes.search-campsite-with-province', ['id']), 'Search\SearchController@searchOnProvince')->name('search-campsite.withprovince');

Route::get(trans('routes.offer-campsite'), 'Campsite\CampsiteController@indexOfferCampsite')->name('offer-campsite');

Route::get(trans('routes.offers'), 'Campsite\CampsiteController@getAllCampsites');
Route::get(trans('routes.campsite', ['id', 'slug?']), 'Campsite\CampsiteController@showCampsite')->name('campsite.display');

Route::get(trans('routes.provinces'), 'Campsite\CampsiteController@getAllProvinces');
Route::get(trans('routes.states'), 'Campsite\CampsiteController@getAllStates');
Route::get(trans('routes.movements'), 'Movement\MovementController@getAllMovements');

Route::get('lang/{language}', 'LanguageController@switchLang')->name('lang.switch');

//    Only logged in users can access these routes else redirected to '/'
Route::group(['middleware' => 'auth'], function()
{
    Route::post(trans('routes.storereview'), 'Review\ReviewController@storeReview')->name('review.store');
    Route::post(trans('routes.save-campsite'), 'Saving\SavingController@statusSaveCampsite');

    Route::post(trans('routes.offer-campsite-save'), 'Campsite\CampsiteController@storeCampsite');
    Route::post(trans('routes.offer-campsite-images-save'), 'Campsite\ImageController@saveImage');

    Route::get(trans('routes.my-profile'), 'HomeController@myProfile')->name('my-profile');
    Route::post(trans('routes.profile-update'), 'HomeController@updateProfile')->name('profile.update');
    Route::post(trans('routes.password-change'), 'HomeController@changePassword')->name('profile.changepassword');

    Route::get(trans('routes.make-reservation', ['id', 'slug?']), 'Reservation\ReservationController@showReservationForm')->name('reservation.showform');
    Route::post(trans('routes.store-reservation'), 'Reservation\ReservationController@makeReservation')->name('reservation.store');
    Route::get(trans('routes.delete-reservation', ['id']), 'Reservation\ReservationController@deleteReservation')->name('reservation.delete');
    Route::get(trans('routes.accept-reservation', ['id']), 'Reservation\ReservationController@acceptReservation')->name('reservation.accept');

});
