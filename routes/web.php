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

if(env('APP_ENV') === 'production') {
  URL::forceSchema('https');
}

Route::resource('posts', 'PostsController');
Route::resource('comments', 'CommentsController', ['except' => 'index']);


Route::get('/', function () {
  return redirect()->action('PostsController@index');
});

Route::get('/about', 'PagesController@about');

Route::post('comments/{post_id}', 'CommentsController@store');


Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
