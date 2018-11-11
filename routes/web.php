<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::get('/', 'PostsController@index')->name('posts');
Route::get('/posts', 'PostsController@index')->name('home');
Route::post('/posts', 'PostsController@store')->name('post.create')->middleware('auth');
Route::get('/delete/{id}', 'PostsController@delete')->name('post.delete')->middleware('auth');

/*
| Когда они успели сделать логоут через POST? O_o
| Это все из за того, что я решил делать виджет, уже пожалел.
 */
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');