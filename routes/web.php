<?php


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/cabinet', 'Cabinet\HomeController@index')->name('cabinet');
Route::get('/verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');

Route::group(
    [
        'prefix' => 'admin',
        'as' => 'admin.',
        'namespace' => 'Admin',
        'middleware' => ['auth'],

    ],
    function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('users', 'UsersController');
        Route::post('/users/{user}/verify', 'UsersController@verify' )->name('users.verify');
    }
);










Route::get('/main', 'MdbController@index');

