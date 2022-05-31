<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
        //start LaravelLocalization




Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@home');

Route::group(['prefix' => '/'], function () {
    Route::group(['prefix' => 'hotels'], function () {
        Route::get("/", 'HomeController@hotels');
        Route::get("/{id}", "HomeController@singleHotel");


        Route::post('/{id}', "HomeController@bookingRoom")->middleware('auth')->name('booking.room');
    });

    Route::group(['prefix' => 'villas'], function () {
        Route::get("/", 'HomeController@villas');
        Route::get("/{id}", "HomeController@singleVilla");
    });

    Route::group(['prefix' => 'hospitals'], function () {
        Route::get("/", 'HomeController@hospitals');
        Route::get("/{id}", "HomeController@singleHospitals");
    });

    Route::group(['prefix' => 'restaurants'], function () {
        Route::get("/", 'HomeController@restaurants');
        Route::get("/{id}", "HomeController@singleRestaurants");
    });

    Route::group(['prefix' => 'stores'], function () {
        Route::get("/", 'HomeController@stores');
        Route::get("/{id}", "HomeController@singleStores");
    });
});

Route::group(['prefix' => '/dashboard', 'middleware' => 'auth'], function () {
    Route::get('/update', 'ProfileController@update')->name('dashboard.update');
    Route::post('/update', 'ProfileController@postUpdate')->name('dashboard.update_profile');

    Route::get('/update-password', 'ProfileController@updatePassword')->name('dashboard.update-password');
    Route::post('/update-password', 'ProfileController@postUpdatePassword')->name('dashboard.update-password-profile');


    Route::get('/cart', 'ProfileController@cart')->name('dashboard.cart');
    Route::get('/cart/{id}', 'ProfileController@deleteCart')->name('dashboard.cart.delete');
    Route::post('/cart/charge', 'ProfileController@charge')->name('dashboard.cart.charge');

    Route::get('/bookings', 'ProfileController@bookings')->name('dashboard.bookings');
});

Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin', 'namespace' => 'Admin\Auth'], function () {
    Route::get('login', 'AdminAuthController@getLogin')->name('adminLogin');
    Route::post('login', 'AdminAuthController@postLogin')->name('adminLoginPost');
    Route::get('logout', 'AdminAuthController@logout')->name('adminLogout');
});

Route::get('search_results', 'HomeController@searchResults');

// Admin Area
Route::group(['prefix' => 'admin', 'middleware' => 'admin:auth', 'namespace' => 'Admin'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('admins', 'AdminController');
    Route::resource('users', 'UserController');
    Route::resource('places', 'PlaceController');
    Route::resource('restaurants', 'RestaurantController');
    Route::post('restaurants/actions/images/{id}', 'RestaurantController@insertPhotos');
    Route::post('restaurants/actions/deleteImage', 'RestaurantController@deleteImage');
    Route::resource('hotels', 'HotelController');
    Route::post('hotels/actions/images/{id}', 'HotelController@insertPhotos');
    Route::post('hotels/actions/deleteImage', 'HotelController@deleteImage');
    Route::resource('rooms', 'RoomController');
    Route::resource('villages', 'VillageController');
    Route::post('villages/actions/images/{id}', 'VillageController@insertPhotos');
    Route::post('villages/actions/deleteImage', 'VillageController@deleteImage');
    Route::resource('stores', 'StoreController');
    Route::post('stores/actions/images/{id}', 'StoreController@insertPhotos');
    Route::post('stores/actions/deleteImage', 'StoreController@deleteImage');
    Route::resource('hospitals', 'HospitalController');
    Route::post('hospitals/actions/images/{id}', 'HospitalController@insertPhotos');
    Route::post('hospitals/actions/deleteImage', 'HospitalController@deleteImage');
    Route::resource('orders', 'OrderController');
});


    //end LaravelLocalization
});