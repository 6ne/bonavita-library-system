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

Route::group(['prefix' => '/api'], function () {
  Route::group(['middleware' => 'guest'], function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
  });

  Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'admin'], function () {
      Route::get('/users', 'UserController@index');

      Route::group(['prefix' => 'transactions'], function () {
        Route::get('/', 'TransactionController@index');
        Route::get('/{id}', 'TransactionController@show');
        Route::get('/user/{id}', 'TransactionController@getUser');
        Route::get('/deadline', 'TransactionController@getDeadline');
        Route::get('/today', 'TransactionController@getToday');
      });
    });

    Route::group(['prefix' => 'notifications'], function () {
      Route::post('/', 'NotificationController@store');
      Route::get('/{user_id}', 'NotificationController@show');
      Route::get('/{user_id}/new', 'NotificationController@new');
      Route::put('/{user_id}/read', 'NotificationController@read');

      Route::put('/{id}/update', 'NotificationController@update');
    });

    Route::group(['prefix' => 'books'], function () {
      Route::get('/', 'BookController@index');
      Route::get('/{id}', 'BookController@show');
    });

    Route::group(['prefix' => 'users'], function () {
      Route::get('/', 'UserController@index');
      Route::get('/{id}', 'UserController@show');
    });

    Route::group(['prefix' => 'transactions'], function () {
      Route::post('/', 'TransactionController@store');
    });

    Route::get('/logout', 'AuthController@logout');
  });
});

Route::group(['middleware' => 'guest'], function () {
  Route::get('/login', 'ViewController@login');
  Route::get('/register', 'ViewController@register');
});

Route::group(['middleware' => 'auth'], function () {
  Route::group(['middleware' => 'admin'], function () {
    Route::get('/users', 'ViewController@users');
    Route::get('/transactions', 'ViewController@transactions');
  });
  Route::get('/', 'ViewController@dashboard');
  Route::get('/notifications', 'ViewController@notifications');
  Route::get('/books', 'ViewController@books');
});
// Route::group(['middleware' => 'jwt.auth'], function () {
// });