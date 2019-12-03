<?php 
Route::group(
  [
    'prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
  ], function(){ 

    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function(){
      Route::get('/index','Dashboard\DashboardController@index')->name('index');
       // Categoriers Routes

      Route::Resource('categories','Dashboard\CategoryController')->except(['show']);

      
      // products Routes 

      Route::Resource('products','Dashboard\ProductController')->except(['show']);
      // users Routes 
      Route::Resource('users','Dashboard\UserController')->except(['show']);

    });
     // user Routes
  });

