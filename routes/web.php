<?php

/*
 * Page
 */
Route::namespace('Page')->group(function(){
    Route::get('/', 'PublicController@about')->name('welcome');
    Route::get('/about', 'PublicController@about')->name('about');
    Route::get('/contact', 'PublicController@contact')->name('contact');
    Route::get('/home', 'HomeController@index')->name('home');
});

/**
 * Auth
 */
Auth::routes();