<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('template', function() {
    return view('template');
});

Route::get('/', 'HomeController@loadHome')->name('/');

Route::get('/under-construction', function () {
    return view('under-construction');
})->name('construction');

/*
Route::get('/packages/under-construction', function () {
    return view('under-construction');
})->name('packages.construction');
 */

Route::get('/packages/{package}', //'PackageController@goToPackage');
        function($package) {
            return view('/packages/'.$package);
        })->name('package');

Route::get('/storage/{filename}', 'StorageController@goToStorage')->name('storage');         

//apartmani
Route::get('/apartments/Belux-Belgrade-apartment', 'ApartmentsController@getApartmanData');
Route::get('/apartments/belgrade-apartments', 'ApartmentsController@getSviApartmaniData');