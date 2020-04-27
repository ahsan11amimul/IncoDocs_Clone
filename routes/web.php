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
/*
Pages Controller or index page
*/
Route::get('/','PagesController@index');
Route::get('/quotes','PagesController@quotes');
Route::get('/invoices','PagesController@invoices');
Route::get('/pricing','PagesController@pricing');
Route::get('/shipping','PagesController@shipping');
Route::get('/purchase','PagesController@purchase');
Route::get('/trade','PagesController@trade');

Route::match(['get', 'post'], '/contact','PagesController@contact')->name('contact');

//register login logout forget password
Route::match(['get', 'post'], '/register','PagesController@register')->name('register');
Route::match(['get', 'post'], '/forgetpassword','PagesController@forgetpassword')->name('forgetpassword');
Route::match(['get', 'post'], '/createpassword/{id}','PagesController@createpassword')->name('createpassword');
Route::get('verifymail/{token}','PagesController@verifyEmail')->name('verifymail');
Route::match(['get', 'post'], '/login','PagesController@login')->name('login');
Route::get('/logout','PagesController@logout')->middleware('auth');
//account updating for both user and admin
Route::match(['get','post'],'/profile','ProfileController@profile')->middleware('auth')->name('profile');

//protected routes for Authentic user 
 Route::group(['middleware' => ['auth','user']], function () {
     //user dashboard
     Route::get('/user/dashboard','DashboardController@user')->name('user.dashboard');
     //user contact
     Route::get('/contacts','User\ContactController@index')->name('contacts.index');
     Route::post('/contacts/store','User\ContactController@store')->name('contacts.store');
     Route::get('/contacts/{id}/edit','User\ContactController@edit')->name('contacts.edit');
     Route::post('/contacts/update','User\ContactController@update')->name('contacts.update');
     Route::get('/contacts/destroy/{id}','User\ContactController@destroy')->name('contacts.destroy');
     //user product
     Route::get('/products','User\ProductController@index')->name('products.index');
     Route::post('/products/store','User\ProductController@store')->name('products.store');
     Route::get('/products/{id}/edit','User\ProductController@edit')->name('products.edit');
     Route::post('/products/update','User\ProductController@update')->name('products.update');
     Route::get('/products/destroy/{id}','User\ProductController@destroy')->name('products.destroy');
     //user detail
     Route::get('/details','User\DetailController@index')->name('details.index');
     Route::post('/details/store','User\DetailController@store')->name('details.store');
     Route::get('/details/{id}/edit','User\DetailController@edit')->name('details.edit');
     Route::post('/details/update','User\DetailController@update')->name('details.update');
     Route::get('/details/destroy/{id}','User\DetailController@destroy')->name('details.destroy');
     //company
     Route::match(['get', 'post'], '/company','ProfileController@company')->name('company');
   // Route::PATCH('/company','ProfileController@company_update');
     Route::get('/plans','ProfileController@plans')->name('plans');
     Route::get('/team','ProfileController@team')->name('team');
     Route::post('/invitation','ProfileController@invitation')->name('invitation');
     //user Invoices
     Route::get('/invoices','User\InvoiceController@index');
     //user Quotes
     Route::get('/quotes','User\QuoteController@index');

     //user Purchases
     Route::get('/purchases','User\PurchaseController@index');
     
 });
//protected routes for Authentic Admin 
Route::group(['middleware' => ['auth','admin']], function () {
    Route::get('/admin/dashboard','DashboardController@admin')->name('admin.dashboard');
});
