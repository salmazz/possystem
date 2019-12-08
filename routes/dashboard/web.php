<?php 
Route::group(
  [
    'prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
   ], function(){ 

    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function(){

      
      Route::get('/','Dashboard\WelcomeController@index')->name('welcome');
       // Categoriers Routes

      Route::Resource('categories','Dashboard\CategoryController')->except(['show']);


      // products Routes 

      Route::Resource('products','Dashboard\ProductController')->except(['show']);
      // users Routes 
      Route::Resource('users','Dashboard\UserController')->except(['show']);
      //client Routes 
      Route::Resource('clients','Dashboard\ClientController')->except(['show']);
      Route::Resource('clients.orders','Dashboard\Client\OrderController')->except(['show']);

      Route::Resource('orders','Dashboard\OrderController')->except(['show']);

    });
  });


