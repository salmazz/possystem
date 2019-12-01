<?php 
Route::group(
  [
    'prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
  ], function(){ 

    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function(){
      Route::get('/index','Dashboard\DashboardController@index')->name('index');
      Route::Resource('users','Dashboard\UserController')->except(['show']);
      Route::Resource('categories','Dashboard\CategoryController')->except(['show']);

    });
     // user Routes
  });

