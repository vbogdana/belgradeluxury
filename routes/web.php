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

/***
 * User
 */
Route::get('login', ['as' => 'cms.login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => 'cms.login', 'uses' => 'Auth\LoginController@login']);
Route::post('logout', ['as' => 'cms.logout', 'uses' => 'Auth\LoginController@logout']);

Route::get('cms/register', ['as' => 'cms.register', 'uses' => 'CMS\RegisterController@showRegistrationForm']);
Route::post('cms/register', ['as' => 'cms.register', 'uses' => 'CMS\RegisterController@register']);

/***
 * Accommodation
 */
Route::get('cms/accommodation', ['as' => 'cms.accommodation', 'uses'=> 'CMS\AccommodationController@loadAccommodation']);
Route::get('cms/accommodation/{accID}/edit/main-photo', ['as' => 'cms.accommodation.edit.main-image', 'uses' => 'CMS\AccommodationController@loadEditMainImage']);
Route::post('cms/accommodation/{accID}/edit/main-photo', ['as' => 'cms.accommodation.edit.main-image', 'uses' => 'CMS\AccommodationController@editMainImage']);
Route::get('cms/accommodation/{accID}/create/photos', ['as' => 'cms.accommodation.create.images', 'uses' => 'CMS\AccommodationController@loadCreateAccommodationImages']);
Route::post('cms/accommodation/{accID}/create/photos', ['as' => 'cms.accommodation.create.images', 'uses' => 'CMS\AccommodationController@createAccommodationImages']);
Route::get('cms/accommodation/{accID}/delete/photos', ['as' => 'cms.accommodation.delete.images', 'uses' => 'CMS\AccommodationController@loadDeleteImages']);
Route::delete('cms/accommodation/{imgID}/delete/photo', ['as' => 'cms.accommodation.delete.image', 'uses' => 'CMS\AccommodationController@deleteImage']);
Route::delete('cms/accommodation/{accID}/delete/main-photo', ['as' => 'cms.accommodation.delete.main-image', 'uses' => 'CMS\AccommodationController@deleteMainImage']);
Route::delete('cms/accommodation/{accID}/delete', ['as' => 'cms.accommodation.delete', 'uses' => 'CMS\AccommodationController@delete']);

Route::get('cms/accommodation/apartments', ['as' => 'cms.accommodation.apartments', 'uses' => 'CMS\ApartmentsController@loadApartments']);
Route::get('cms/accommodation/apartment/create', ['as' => 'cms.accommodation.apartment.create', 'uses' => 'CMS\ApartmentsController@loadCreateApartment']);
Route::post('cms/accommodation/apartment/create', ['as' => 'cms.accommodation.apartment.create', 'uses' => 'CMS\ApartmentsController@createApartment']);
Route::get('cms/accommodation/{accID}/apartment/edit', ['as' => 'cms.accommodation.apartment.edit', 'uses' => 'CMS\ApartmentsController@loadEditApartment']);
Route::post('cms/accommodation/{accID}/apartment/edit', ['as' => 'cms.accommodation.apartment.edit', 'uses' => 'CMS\ApartmentsController@editApartment']);

/***
 * Vehicles
 */
Route::get('cms/vehicles', ['as' => 'cms.vehicles', 'uses' => 'CMS\VehiclesController@loadVehicles']);
Route::get('cms/vehicles/create', ['as' => 'cms.vehicles.create', 'uses' => 'CMS\VehiclesController@loadCreateVehicle']);
Route::post('cms/vehicles/create', ['as' => 'cms.vehicles.create', 'uses' => 'CMS\VehiclesController@createVehicle']);
Route::get('cms/vehicles/{vehID}/edit', ['as' => 'cms.vehicles.edit', 'uses' => 'CMS\VehiclesController@loadEditVehicle']);
Route::post('cms/vehicles/{vehID}/edit', ['as' => 'cms.vehicles.edit', 'uses' => 'CMS\VehiclesController@editVehicle']);
Route::get('cms/vehicles/{vehID}/edit/main-photo', ['as' => 'cms.vehicles.edit.main-image', 'uses' => 'CMS\VehicleImagesController@loadEditMainImage']);
Route::post('cms/vehicles/{vehID}/edit/main-photo', ['as' => 'cms.vehicles.edit.main-image', 'uses' => 'CMS\VehicleImagesController@editMainImage']);
Route::get('cms/vehicles/{vehID}/create/photos', ['as' => 'cms.vehicles.create.images', 'uses' => 'CMS\VehicleImagesController@loadCreateVehicleImages']);
Route::post('cms/vehicles/{vehID}/create/photos', ['as' => 'cms.vehicles.create.images', 'uses' => 'CMS\VehicleImagesController@createVehicleImages']);
Route::get('cms/vehicles/{vehID}/delete/photos', ['as' => 'cms.vehicles.delete.images', 'uses' => 'CMS\VehicleImagesController@loadDeleteImages']);
Route::delete('cms/vehicles/{imgID}/delete/photo', ['as' => 'cms.vehicles.delete.image', 'uses' => 'CMS\VehicleImagesController@deleteImage']);
Route::delete('cms/vehicles/{vehID}/delete/main-photo', ['as' => 'cms.vehicles.delete.main-image', 'uses' => 'CMS\VehicleImagesController@deleteMainImage']);
Route::delete('cms/vehicles/{vehID}/delete', ['as' => 'cms.vehicles.delete', 'uses' => 'CMS\VehiclesController@delete']);
