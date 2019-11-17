<?php 


Route::prefix('dashboard')->name('dashboard.')->group(function(){
  Route::get('/index','Dashboard\DashboardController@index')->name('index');
});
