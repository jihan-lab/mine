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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/categories', 'CategoryController@index')->name('categories');
Route::get('/categories/{id}', 'CategoryController@detail')->name('categories-details');

Route::get('/details/{id}', 'DetailController@index')->name('details');

Route::get('/cart', 'CartController@index')->name('cart');
Route::get('/success', 'CartController@success')->name('success');

Route::get('/register/success', 'Auth\RegisterController@success')->name('register-success');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/dashboard/products', 'DashboardProductController@index')->name('dashboard-products');
Route::get('/dashboard/products/create', 'DashboardProductController@create')->name('dashboard-products-create');
Route::get('/dashboard/products/{id}', 'DashboardProductController@detail')->name('dashboard-products-detail');

Route::get('/dashboard/transactions', 'DashboardTransactionController@index')->name('dashboard-transactions');
Route::get('/dashboard/transactions/{id}', 'DashboardTransactionController@detail')->name('dashboard-transactions-details');

Route::get('/dashboard/settings', 'DashboardSettingController@store')->name('dashboard-settings');
Route::get('/dashboard/account', 'DashboardSettingController@account')->name('dashboard-account');

Route::prefix('admin') // ini untuk rout nya, jadi setiap yg manggil '/admin' di url lari kesini.
    ->namespace('Admin') // ini untuk nama folder untuk manggil controller karena ada di folder Admin.
    // ->middleware('auth', 'admin')
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('admin-dashboard');
    });

Auth::routes();
