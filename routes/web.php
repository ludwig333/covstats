<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'FrontEndController@index')->name('home');
Route::get('/scrape', 'ScraperController@scrape')->name('scrape');
Route::get('/countries', 'FrontEndController@countries')->name('countries');
Route::post('/countries-ajax', 'FrontEndController@countries_ajax')->name('countries.ajax');
Route::get('/country/{code}', 'FrontEndController@country_details')->name('country');
Route::get('/country-details', 'FrontEndController@country_details')->name('country.details');

Route::get('/symptoms', 'PagesController@symptoms')->name('symptom');
Route::get('/prevention', 'PagesController@prevention')->name('prevent');
Route::get('/faqs', 'PagesController@faqs')->name('faq');



Route::get('/clear', function () {
	\Artisan::call('cache:clear');
});
Route::get('/cache', function () {
	$Covid = new \App\Http\Controllers\CovidDataController;
	$Covid->countries_data();
	$Covid->daily_data();
	$Covid->timeline_data();
});


Route::get('/console', function () {
	$Covid = new \App\Http\Controllers\CovidDataController;
	dd($Covid->get_live_data());
});