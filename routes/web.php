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
 * Users
 */
Route::prefix('admin')->namespace('User')->name('admin.')->group(function(){
    /**
     * Account
     */
    // Route::get('/accounts/list', 'AccountController@list')->name('accounts.list');
    Route::resource('/accounts', 'AccountController', [
        'parameters' => ['accounts' => 'user'],
        'only' => ['index','store', 'show', 'update', 'destroy']
    ]);
});