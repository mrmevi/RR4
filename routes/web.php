<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'App\Http\Controllers\admin\MainController@index')->name('admin.index');
    Route::resource('/posts', 'App\Http\Controllers\admin\PostController');
    Route::resource('/users', 'App\Http\Controllers\admin\UserController');
    Route::resource('/fish', 'App\Http\Controllers\admin\FishController');
    Route::resource('/basins', 'App\Http\Controllers\admin\BasinController');
    Route::get('/posts/decide/{id}', 'App\Http\Controllers\admin\PostController@decide')->name( 'posts.decide');
    Route::get('/posts/dontDecide/{id}', 'App\Http\Controllers\admin\PostController@dontDecide')->name( 'posts.dontDecide');
});

/*Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/article/{slug}', 'App\Http\Controllers\HomeController@show')->name('home.article');
Route::get('/fish', 'App\Http\Controllers\FishController@index')->name('home.fish');
Route::get('/fish/{slug}', 'App\Http\Controllers\FishController@show')->name('home.fish.article');
Route::get('/basin', 'App\Http\Controllers\BasinController@index')->name('home.basins');
Route::get('/basin/{slug}', 'App\Http\Controllers\BasinController@show')->name('home.basins.article');
Route::get('/post/create', 'App\Http\Controllers\PostController@create')->name('home.posts.create');
Route::post('/post/store', 'App\Http\Controllers\PostController@store')->name('home.posts.store');
Route::get('/profile/{id}', 'App\Http\Controllers\UserController@profile')->name('home.user.profile');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', 'App\Http\Controllers\admin\MainController@index')->name('admin.index');
    Route::resource('/fish', 'App\Http\Controllers\admin\FishController');
    Route::resource('/basins', 'App\Http\Controllers\admin\BasinController');
    Route::resource('/posts', 'App\Http\Controllers\admin\PostController');
    Route::get('/posts/decide/{id}', 'App\Http\Controllers\admin\PostController@decide')->name( 'posts.decide');
    Route::get('/posts/dontDecide/{id}', 'App\Http\Controllers\admin\PostController@dontDecide')->name( 'posts.dontDecide');
    Route::resource('/users', 'App\Http\Controllers\admin\UserController');
});

Route::group(['middleware' => 'guest'], function (){
    Route::get('/register', 'App\Http\Controllers\UserController@create')->name('register.create');
    Route::post('/register', 'App\Http\Controllers\UserController@store')->name('register.store');
    Route::get('/login', 'App\Http\Controllers\UserController@loginForm')->name('login.create');
    Route::post('/login', 'App\Http\Controllers\UserController@login')->name('login');
});

Route::get('/logout', 'App\Http\Controllers\UserController@logout')->name('logout')->middleware('auth');*/
