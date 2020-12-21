<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;
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
Route::get('/', 'MainPageController@index');
Route::get('/new-user', function () { return view('new-user');})->name('new-user');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home/portfolioDelete', 'HomeController@portfolioDelete')->name('portfolioDelete');
Route::post('/home/bookings', 'HomeController@bookings')->name('bookings');
Route::post('/home/deleteBooking', 'HomeController@deleteBooking')->name('deleteBooking');
Route::post('/home/editBooking', 'HomeController@editBooking')->name('editBooking');
Route::post('/home/checkOffers', 'HomeController@checkOffers')->name('checkOffers');
Route::post('/home/changeBooking', 'HomeController@changeBooking')->name('changeBooking');
Route::post('/home/checkBooking', 'HomeController@checkBooking')->name('checkBooking');

Route::get('/dashboard', 'HomeController@proDash')->name('dashboard');
Route::post('/dashboard/sendoffer', 'HomeController@sendOffer')->name('sendoffer');
Route::post('/dashboard/sendofferdel', 'HomeController@sendofferdel')->name('sendofferdel');
Route::post('/dashboard/send_complete', 'HomeController@send_complete')->name('send_complete');

Route::get('/client-register', 'HomeController@client_register')->name('client-register');
Route::get('/pro-register', 'HomeController@pro_register')->name('pro-register');
Route::get('/view-package/{id}', 'PublicProfileController@viewPackage')->name('viewpackage');
Route::resource('/settings', 'ProfessionalController');
Route::resource('/package', 'ProPackageController');
Route::resource('/schedule', 'ProScheduleController');

Route::get('change-image/', 'ImageProfileController@index')->name('imageprofile');;
Route::post('change-image/upload', 'ImageProfileController@profileUpload')->name('changeProfile');
Route::post('change-image/uploadpic', 'ImageProfileController@profileUploadFromBase64')->name('changeProfileBase64');

Route::get('new-photo/', 'NewPhotoController@index')->name('upload-photo');
Route::get('new-photo/store', 'NewPhotoController@StorePhoto')->name('store-photo');

Route::resource('/new-booking', 'NewBookingController');

Route::get('/feedback/{id}', 'FeedbackController@index')->name('feedback');
Route::post('/feedback/create', 'FeedbackController@create');
Route::resource('/feedback', 'FeedbackController');

Route::get('/stripe-payment', 'StripeController@handleGet')->name('handleGet');
Route::post('/stripe-payment', 'StripeController@handlePost')->name('stripe.payment');
