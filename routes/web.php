<?php

/*
|
|--------------------------------------------------------------------------
| APP Web Routes
|--------------------------------------------------------------------------
|
*/
//Auth::routes();
//Route::get('/storage/{filename}', 'StorageController@goToStorage')->name('storage');

Route::get('/', 'App\AppController@index')->name('/');
//Route::get('home', 'App\HomeController@index')->name('home');

Route::get('/packages', function() {
    return view('/packages/package');
});

/*
Route::get('/under-construction', function () {
    return view('under-construction');
})->name('construction');
 */

/*
Route::get('/packages/under-construction', function () {
    return view('under-construction');
})->name('packages.construction');
 */

/*
Route::get('/packages/{package}', //'PackageController@goToPackage');
        function($package) {
            return view('/packages/'.$package);
        })->name('package');         

//apartmani
Route::get('/apartments/Belux-Belgrade-apartment', 'ApartmentsController@getApartmanData');
Route::get('/apartments/belgrade-apartments', 'ApartmentsController@getSviApartmaniData');
*/

/*
|
|--------------------------------------------------------------------------
| CMS Web Routes
|--------------------------------------------------------------------------
|
 */

Route::get('cms', 'CMS\CMSController@index')->name('cms');

// dok se ne uvede prijavljivanje korisnika
Route::get('login', ['as' => 'cms.login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => 'cms.login', 'uses' => 'Auth\LoginController@login']);
Route::post('logout', ['as' => 'cms.logout', 'uses' => 'Auth\LoginController@logout']);

Route::get('cms/register', ['as' => 'cms.register', 'uses' => 'CMS\RegisterController@showRegistrationForm']);
Route::post('cms/register', ['as' => 'cms.register', 'uses' => 'CMS\RegisterController@register']);

Route::get('cms/apartments', ['as' => 'cms.apartments', 'uses' => 'CMS\ApartmentsController@loadApartments']);

Route::get('cms/create/apartment', ['as' => 'cms.create.apartment', 'uses' => 'CMS\ApartmentsController@loadCreateApartment']);
Route::post('cms/create/apartment', ['as' => 'cms.create.apartment', 'uses' => 'CMS\ApartmentsController@createApartment']);

Route::get('cms/create/accommodation/{accID}/image', ['as' => 'cms.create.accommodation.image', 'uses' => 'CMS\AccommodationController@loadAccommodationImage']);
Route::post('cms/create/accommodation/{accID}/image', ['as' => 'cms.create.accommodation.image', 'uses' => 'CMS\AccommodationController@createAccommodationImage']);

Route::delete('cms/delete/accommodation/{accID}', ['as' => 'cms.delete.accommodation', 'uses' => 'CMS\AccommodationController@deleteAccommodation']);