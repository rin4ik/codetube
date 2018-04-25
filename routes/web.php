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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::post('/webhook/encoding', 'EncodingWebhookController@handle');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/videos/{video}', 'VideoController@show');
Route::post('/videos/{video}/views', 'VideoViewController@store');
Route::get('/videos/{video}/votes', 'VideoVoteController@show');

Route::get('/search', 'SearchController@index');

Route::get('/videos/{video}/comments', 'VideoCommentController@index');
Route::get('/subscriptions/{channel}', 'ChannelSubscriptionController@show');
Route::resource('/posts', 'VideoController');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/upload', 'VideoUploadController@index');
    Route::post('/upload', 'VideoUploadController@store');
    Route::get('/videos', 'VideoController@index');
    Route::post('/videos', 'VideoController@store');
    Route::delete('/videos/{video}', 'VideoController@delete');
    Route::get('/videos/{video}/edit', 'VideoController@edit');
    Route::put('/videos/{video}', 'VideoController@update');
    Route::put('/channel/{channel}/edit', 'ChannelSettingsController@update');
    Route::post('/videos/{video}/votes', 'VideoVoteController@create');
    Route::delete('/videos/{video}/votes', 'VideoVoteController@remove');
    Route::post('/videos/{video}/comments', 'VideoCommentController@create');
    Route::delete('/videos/{video}/comments/{comment}', 'VideoCommentController@delete');
    Route::post('/subscription/{channel}', 'ChannelSubscriptionController@create');
    Route::delete('/subscription/{channel}', 'ChannelSubscriptionController@delete');
});

Route::get('/channel/{channel}/edit', 'ChannelSettingsController@edit');
