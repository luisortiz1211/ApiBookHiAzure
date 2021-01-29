<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', 'App\\Http\\Controllers\\UserController@register');
Route::post('login', 'App\\Http\\Controllers\\UserController@authenticate');
Route::get('books', 'App\\Http\\Controllers\\BookController@index');
Route::get('books/available', 'App\\Http\\Controllers\\BookController@available');
Route::get('books/{book}', 'App\\Http\\Controllers\\BookController@show');
Route::get('categories', 'App\\Http\\Controllers\\CategoryController@index');
Route::get('books/categories/{category}', 'App\\Http\\Controllers\\BookController@filter');

Route::group(['middleware' => ['jwt.verify']], function () {

    Route::get('user', 'App\\Http\\Controllers\\UserController@getAuthenticatedUser');
    Route::put('user', 'App\\Http\\Controllers\\UserController@update');

    //CHAT
    Route::get('chats', 'App\\Http\\Controllers\\ChatController@index');
    Route::post('chats', 'App\\Http\\Controllers\\ChatController@store');
    //Route::delete('chats/{chat}', 'App\\Http\\Controllers\\ChatController@delete');

    //MESSAGES
    Route::get('chats/{chat}/messages', 'App\\Http\\Controllers\\MessageController@index');
    Route::post('chats/{chat}/messages', 'App\\Http\\Controllers\\MessageController@store');
    //Route::delete('chat/messages/{message}', 'App\\Http\\Controllers\\MessageController@delete');

    //BOOKS
    Route::get('user/books', 'App\\Http\\Controllers\\BookController@showmybooks');
    Route::post('user/books', 'App\\Http\\Controllers\\BookController@store');
    Route::put('user/books/{book}', 'App\\Http\\Controllers\\BookController@update');
    Route::delete('user/books/{book}', 'App\\Http\\Controllers\\BookController@delete');

});
