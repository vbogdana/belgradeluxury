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

// Contact us


Route::group([
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localize', 'localeSessionRedirect', 'localizationRedirect' ]
    ], function() {
        /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    
        // Index page
        Route::get('/', ['as' => '/', 'uses' => 'App\AppController@loadIndex']);
        
        //Contact page
        Route::get(LaravelLocalization::transRoute('routes.contact'), 
            [
                'as' => 'contact', 
                'uses' => function() {
                  return view('contact');
                }
            ]
        );
        Route::post(LaravelLocalization::transRoute('routes.contact'),
            [
                'as' => 'contact', 
                'uses' => 'App\AppController@contact'
            ]
        );
        
        // Template for a single package
        Route::get(LaravelLocalization::transRoute('routes.packages'), 
            [
              'as' => 'packages', 
              'uses' => function() {
                  return view('/packages/package');
                }
            ]
        );
        
        // List accommodation services
        Route::get(LaravelLocalization::transRoute('routes.accommodation'), 
            [
              'as' => 'accommodation', 
              'uses' => 'App\AccommodationController@loadAccommodation'
            ]
        );
        
        // Single apartment page
        Route::get(LaravelLocalization::transRoute('routes.apartment'), 
            [
              'as' => 'accommodation.apartment', 
              'uses' => 'App\AccommodationController@loadApartment'
            ]
        );
        
        // List vehicles services
        Route::get(LaravelLocalization::transRoute('routes.vehicles'), 
            [
              'as' => 'vehicles', 
              'uses' => 'App\VehiclesController@loadVehicles'
            ]
        );
        
        // Single vehicle page
        Route::get(LaravelLocalization::transRoute('routes.vehicle'), 
            [
              'as' => 'vehicles.vehicle', 
              'uses' => 'App\VehiclesController@loadVehicle'
            ]
        );
    });
    
//Route::get('home', 'App\HomeController@index')->name('home');


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

/***
 * Testemonials
 */
Route::get('cms/testemonials', ['as' => 'cms.testemonials', 'uses' => 'CMS\TestemonialsController@loadTestemonials']);
Route::get('cms/testemonials/create', ['as' => 'cms.testemonials.create', 'uses' => 'CMS\TestemonialsController@loadCreateTestemonial']);
Route::post('cms/testemonials/create', ['as' => 'cms.testemonials.create', 'uses' => 'CMS\TestemonialsController@createTestemonial']);
Route::get('cms/testemonials/{testID}/edit', ['as' => 'cms.testemonials.edit', 'uses' => 'CMS\TestemonialsController@loadEditTestemonial']);
Route::post('cms/testemonials/{testID}/edit', ['as' => 'cms.testemonials.edit', 'uses' => 'CMS\TestemonialsController@editTestemonial']);
Route::get('cms/testemonials/{testID}/edit/main-photo', ['as' => 'cms.testemonials.edit.main-image', 'uses' => 'CMS\TestemonialsController@loadEditMainImage']);
Route::post('cms/testemonials/{testID}/edit/main-photo', ['as' => 'cms.testemonials.edit.main-image', 'uses' => 'CMS\TestemonialsController@editMainImage']);
Route::delete('cms/testemonials/{testID}/delete/main-photo', ['as' => 'cms.testemonials.delete.main-image', 'uses' => 'CMS\TestemonialsController@deleteMainImage']);
Route::delete('cms/testemonials/{testID}/delete', ['as' => 'cms.testemonials.delete', 'uses' => 'CMS\TestemonialsController@delete']);

/***
 * Packages
 */
Route::get('cms/packages', ['as' => 'cms.packages', 'uses' => 'CMS\PackagesController@loadPackages']);
Route::get('cms/packages/create', ['as' => 'cms.packages.create', 'uses' => 'CMS\PackagesController@loadCreatePackage']);
Route::post('cms/packages/create', ['as' => 'cms.packages.create', 'uses' => 'CMS\PackagesController@createPackage']);
Route::get('cms/packages/{packID}/edit', ['as' => 'cms.packages.edit', 'uses' => 'CMS\PackagesController@loadEditPackage']);
Route::post('cms/packages/{packID}/edit', ['as' => 'cms.packages.edit', 'uses' => 'CMS\PackagesController@editPackage']);
Route::get('cms/packages/{packID}/edit/photo/{imgType}', ['as' => 'cms.packages.edit.image', 'uses' => 'CMS\PackagesController@loadEditImage']);
Route::post('cms/packages/{packID}/edit/photo/{imgType}', ['as' => 'cms.packages.edit.image', 'uses' => 'CMS\PackagesController@editImage']);
Route::delete('cms/packages/{packID}/delete/photo/{imgType}', ['as' => 'cms.packages.delete.image', 'uses' => 'CMS\PackagesController@deleteImage']);
Route::delete('cms/packages/{packID}/delete', ['as' => 'cms.packages.delete', 'uses' => 'CMS\PackagesController@delete']);
Route::post('cms/packages/{packID}/show', ['as' => 'cms.packages.show', 'uses' => 'CMS\PackagesController@show']);
Route::post('cms/packages/{packID}/hide', ['as' => 'cms.packages.hide', 'uses' => 'CMS\PackagesController@hide']);
Route::get('cms/packages/reorder', ['as' => 'cms.packages.reorder', 'uses' => 'CMS\PackagesController@loadReorderPackages']);
Route::post('cms/packages/reorder', ['as' => 'cms.packages.reorder', 'uses' => 'CMS\PackagesController@reorderPackages']);
