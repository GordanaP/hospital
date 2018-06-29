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


/**
 * User
 */
Route::prefix('admin')->namespace('User')->name('admin.')->group(function(){

    /**
     * Account
     */
    Route::resource('/accounts', 'AccountController', [
        'parameters' => ['accounts' => 'user'],
        'only' => ['index','store', 'show', 'update', 'destroy']
    ]);

    /**
     * Profile
     */
    Route::get('profiles/{profile}/edit', 'ProfileController@edit')->name('profiles.edit');
    Route::resource('/profiles', 'ProfileController', [
        'parameters' => ['profiles' => 'user'],
        'only' => ['show', 'update']
    ]);
});