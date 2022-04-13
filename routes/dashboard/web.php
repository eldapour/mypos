<?php

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){

    Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {

        // home routes
        Route::get('/','HomeController@index')->name('home');
        Route::get('/logout','HomeController@logout')->name('logout');

        // categories routes
        Route::resource('categories','CategoryController')->except('show');

        // products routes
        Route::resource('products','ProductController')->except('show');

        // clients routes
        Route::resource('clients','ClientController')->except('show');
        Route::resource('clients.orders','Client\OrderController')->except('show');

        // orders routes
        Route::resource('orders','OrderController');
        Route::get('/orders/{order}/products','OrderController@products')->name('orders.products');

        // users routes
        Route::resource('users','UserController')->except('show');
    }); // end of dashboards routes
});
