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
use App\Http\Controllers\App\AppController;

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
                'uses' => 'App\AppController@loadContact'
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
                    AppController::loadServices($services, $packages);
                    return view('/packages/package', ['services' => $services, 'packages' => $packages]);
                }
            ]
        );
        
        // List accommodation services
        Route::get(LaravelLocalization::transRoute('routes.accommodation'), 
            [
              'as' => 'accommodation', 
              'uses' => 'App\ServicesController@loadAccommodation'
            ]
        );
        
        // Single apartment page
        Route::get(LaravelLocalization::transRoute('routes.apartment'), 
            [
              'as' => 'accommodation.apartment', 
              'uses' => 'App\ServicesController@loadApartment'
            ]
        );
        
        // List vehicles services
        Route::get(LaravelLocalization::transRoute('routes.vehicles'), 
            [
              'as' => 'vehicles', 
              'uses' => 'App\ServicesController@loadVehicles'
            ]
        );
        
        // Single vehicle page
        Route::get(LaravelLocalization::transRoute('routes.vehicle'), 
            [
              'as' => 'vehicles.vehicle', 
              'uses' => 'App\ServicesController@loadVehicle'
            ]
        );
        
        // List host services
        Route::get(LaravelLocalization::transRoute('routes.host'), 
            [
              'as' => 'host', 
              'uses' => 'App\ServicesController@loadHosts'
            ]
        );
        
        Route::get('/l')->name('wellness-&-spa');
        Route::get('/lll')->name('reservations');
        Route::get('/llll')->name('security');
        Route::get('/lllll')->name('events');
        Route::get('/llllll')->name('nightlife');
        Route::get('/lllllll')->name('business');
        Route::get('/llllllll')->name('personel');
        Route::get('/lllllllll')->name('sightseeing');
        Route::get('/llllllllll')->name('diamond');
    });

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

/***
 * Hosts
 */
Route::get('cms/host', ['as' => 'cms.host', 'uses' => 'CMS\HostsController@loadHosts']);
Route::get('cms/host/create', ['as' => 'cms.host.create', 'uses' => 'CMS\HostsController@loadCreateHost']);
Route::post('cms/host/create', ['as' => 'cms.host.create', 'uses' => 'CMS\HostsController@createHost']);
Route::get('cms/host/{hostID}/edit', ['as' => 'cms.host.edit', 'uses' => 'CMS\HostsController@loadEditHost']);
Route::post('cms/host/{hostID}/edit', ['as' => 'cms.host.edit', 'uses' => 'CMS\HostsController@editHost']);
Route::get('cms/host/{hostID}/edit/main-photo', ['as' => 'cms.host.edit.main-image', 'uses' => 'CMS\HostsController@loadEditMainImage']);
Route::post('cms/host/{hostID}/edit/main-photo', ['as' => 'cms.host.edit.main-image', 'uses' => 'CMS\HostsController@editMainImage']);
Route::delete('cms/host/{hostID}/delete/main-photo', ['as' => 'cms.host.delete.main-image', 'uses' => 'CMS\HostsController@deleteMainImage']);
Route::delete('cms/host/{hostID}/delete', ['as' => 'cms.host.delete', 'uses' => 'CMS\HostsController@delete']);

/***
 * Places
 */
Route::get('cms/places', ['as' => 'cms.places', 'uses' => 'CMS\PlacesController@loadPlaces']);
Route::get('cms/places/create', ['as' => 'cms.places.create', 'uses' => 'CMS\PlacesController@loadCreatePlace']);
Route::post('cms/places/create', ['as' => 'cms.places.create', 'uses' => 'CMS\PlacesController@createPlace']);
Route::get('cms/places/{placeID}/edit', ['as' => 'cms.places.edit', 'uses' => 'CMS\PlacesController@loadEditPlace']);
Route::post('cms/places/{placeID}/edit', ['as' => 'cms.places.edit', 'uses' => 'CMS\PlacesController@editPlace']);
Route::get('cms/places/{placeID}/edit/main-photo', ['as' => 'cms.places.edit.main-image', 'uses' => 'CMS\PlaceImagesController@loadEditMainImage']);
Route::post('cms/places/{placeID}/edit/main-photo', ['as' => 'cms.places.edit.main-image', 'uses' => 'CMS\PlaceImagesController@editMainImage']);
Route::get('cms/places/{placeID}/create/photos', ['as' => 'cms.places.create.images', 'uses' => 'CMS\PlaceImagesController@loadCreatePlaceImages']);
Route::post('cms/places/{placeID}/create/photos', ['as' => 'cms.places.create.images', 'uses' => 'CMS\PlaceImagesController@createPlaceImages']);
Route::get('cms/places/{placeID}/delete/photos', ['as' => 'cms.places.delete.images', 'uses' => 'CMS\PlaceImagesController@loadDeleteImages']);
Route::delete('cms/places/{imgID}/delete/photo', ['as' => 'cms.places.delete.image', 'uses' => 'CMS\PlaceImagesController@deleteImage']);
Route::delete('cms/places/{placeID}/delete/main-photo', ['as' => 'cms.places.delete.main-image', 'uses' => 'CMS\PlaceImagesController@deleteMainImage']);
Route::delete('cms/places/{placeID}/delete', ['as' => 'cms.places.delete', 'uses' => 'CMS\PlacesController@delete']);
