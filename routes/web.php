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
Route::get('/quote','PagesController@quote');
Route::get('/invoice','PagesController@invoice');
Route::get('/price','PagesController@price');
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
//online resources
Route::get('/quotes/{key}/view','OnlineController@view_quote');  
Route::get('/quotes/{quote}/accept','OnlineController@accept_quote');
//Route::get('/quotes/{quote}/unaccept','OnlineController@unaccept_quote');
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
     Route::get('/invoices/{invoice}/show','User\InvoiceController@show');
     Route::get('/invoices/{invoice}/download','User\InvoiceController@downloadPdf');
     Route::get('/invoices/{invoice}/print','User\InvoiceController@printPdf');
     Route::get('/invoices/{invoice}/send','User\InvoiceController@sendInvoice');
     Route::get('/invoices/create_profarma','User\InvoiceController@create_profarma');
     Route::get('/invoices/get_product','User\InvoiceController@get_product');
     Route::post('/invoices/profarma','User\InvoiceController@store_profarma')->name('invoices.profarma');
     Route::get('/invoices/{invoice}/edit','User\InvoiceController@edit')->name('invoices.edit');
   // Route::post('invoices/update','User\InvoiceController@update')->name('invoices.update');
     Route::post('/invoice/{invoice}/update','User\InvoiceController@update')->name('invoice.update');
     Route::get('/invoices/destroy/{invoice}','User\InvoiceController@destroy');
     Route::get('/invoices/create_commercial','User\InvoiceController@create_commercial');
     Route::post('/invoices/commercial','User\InvoiceController@store_commercial')->name('invoices.commercial');
     //user Quotes 
     Route::get('/quotes','User\QuoteController@index'); 
     Route::get('/quotes/create','User\QuoteController@create'); 
     Route::post('/quotes','User\QuoteController@store')->name('quotes.store');
     Route::get('/quotes/{quote}/show','User\QuoteController@show')->name('quotes.show');
     Route::get('/quotes/{quote}/edit','User\QuoteController@edit')->name('quotes.edit');
     Route::post('/quotes/{quote}/update','User\QuoteController@update')->name('quotes.update');
     Route::get('/quotes/destroy/{quote}','User\QuoteController@destroy');
     Route::get('/quotes/{quote}/download','User\QuoteController@downloadPdf');
     Route::get('/quotes/{quote}/print','User\QuoteController@printPdf');
     Route::post('/quotes/send','User\QuoteController@sendQuote');
     Route::get('/quotes/getInfo/{id}','User\QuoteController@getInfo');

     //user Purchases
     Route::get('/purchases','User\PurchaseController@index');
     Route::get('/purchases/create','User\PurchaseController@create'); 
     Route::post('/purchases','User\PurchaseController@store')->name('purchases.store');
     Route::get('/purchases/{purchase}/show','User\PurchaseController@show')->name('purchases.show');
     Route::get('/purchases/{purchase}/edit','User\PurchaseController@edit')->name('purchases.edit');
     Route::post('/purchases/{purchase}/update','User\PurchaseController@update')->name('purchases.update');
     Route::get('/purchases/destroy/{purchase}','User\PurchaseController@destroy');
     Route::get('/purchases/{purchase}/download','User\PurchaseController@downloadPdf');
     Route::get('/purchases/{purchase}/print','User\PurchaseController@printPdf');
     Route::post('/purchases/send','User\PurchaseController@sendPurchase');
     Route::get('/purchases/getInfo/{id}','User\PurchaseController@getInfo');
     
 }); 
//protected routes for Authentic Admin 
Route::group(['middleware' => ['auth','admin']], function () {
    Route::get('/admin/dashboard','DashboardController@admin')->name('admin.dashboard');
    //admin user
    Route::get('/users','Admin\UserController@index');
    Route::post('/users/store','Admin\UserController@store');
    Route::get('/users/destroy/{id}','Admin\UserController@destroy');
    //admin country  
    
     Route::get('/countries','Admin\CountryController@index')->name('countries.index');
     Route::post('/countries/store','Admin\CountryController@store')->name('countries.store');
     Route::get('/countries/{id}/edit','Admin\CountryController@edit')->name('countries.edit');
     Route::post('/countries/update','Admin\CountryController@update')->name('countries.update');
     Route::get('/countries/destroy/{id}','Admin\CountryController@destroy')->name('countries.destroy');
    //admin places
     Route::get('/places','Admin\PlaceController@index')->name('places.index');
     Route::post('/places/store','Admin\PlaceController@store')->name('places.store');
     Route::get('/places/{id}/edit','Admin\PlaceController@edit')->name('places.edit');
     Route::post('/places/update/{id}','Admin\PlaceController@update')->name('places.update');
     Route::get('/places/destroy/{id}','Admin\PlaceController@destroy')->name('places.destroy');

     //admin dispatch method
     Route::get('/dispatch','Admin\DispatchController@index')->name('dispatch.index');
     Route::post('/dispatch/store','Admin\DispatchController@store')->name('dispatch.store');
     Route::get('/dispatch/{id}/edit','Admin\DispatchController@edit')->name('dispatch.edit');
     Route::post('/dispatch/update','Admin\DispatchController@update')->name('dispatch.update');
     Route::get('/dispatch/destroy/{id}','Admin\DispatchController@destroy')->name('places.destroy');


});
