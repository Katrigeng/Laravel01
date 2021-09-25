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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::post('/test', 'StaticPagesController@test');
Route::get('/list', 'StaticPagesController@list');

Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');


Route::get('/signup', 'UsersController@create')->name('signup');
Route::resource('users', 'UsersController');
// 使用 resource 方法生成的符合 RESTful 架构的路由
// +--------+-----------+-------------------+---------------+--------------------------------------------------+------------+
// | Domain | Method    | URI               | Name          | Action                                           | Middleware |
// +--------+-----------+-------------------+---------------+--------------------------------------------------+------------+
// |        | GET|HEAD  | /                 | home          | App\Http\Controllers\StaticPagesController@home  | web        |
// |        | GET|HEAD  | about             | about         | App\Http\Controllers\StaticPagesController@about | web        |
// |        | GET|HEAD  | api/user          |               | Closure                                          | api        |
// |        |           |                   |               |                                                  | auth:api   |
// |        | GET|HEAD  | help              | help          | App\Http\Controllers\StaticPagesController@help  | web        |
// |        | GET|HEAD  | login             | login         | App\Http\Controllers\SessionsController@create   | web        |
// |        |           |                   |               |                                                  | guest      |
// |        | POST      | login             | login         | App\Http\Controllers\SessionsController@store    | web        |
// |        | DELETE    | logout            | logout        | App\Http\Controllers\SessionsController@destroy  | web        |
// |        | GET|HEAD  | signup            | signup        | App\Http\Controllers\UsersController@create      | web        |
// |        |           |                   |               |                                                  | guest      |
// |        | GET|HEAD  | users             | users.index   | App\Http\Controllers\UsersController@index       | web        |
// |        |           |                   |               |                                                  | auth       |
// |        | POST      | users             | users.store   | App\Http\Controllers\UsersController@store       | web        |
// |        | GET|HEAD  | users/create      | users.create  | App\Http\Controllers\UsersController@create      | web        |
// |        |           |                   |               |                                                  | guest      |
// |        | GET|HEAD  | users/{user}      | users.show    | App\Http\Controllers\UsersController@show        | web        |
// |        | PUT|PATCH | users/{user}      | users.update  | App\Http\Controllers\UsersController@update      | web        |
// |        |           |                   |               |                                                  | auth       |
// |        | DELETE    | users/{user}      | users.destroy | App\Http\Controllers\UsersController@destroy     | web        |
// |        |           |                   |               |                                                  | auth       |
// |        | GET|HEAD  | users/{user}/edit | users.edit    | App\Http\Controllers\UsersController@edit        | web        |
// |        |           |                   |               |                                                  | auth       |
// +--------+-----------+-------------------+---------------+--------------------------------------------------+------------+



Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

Route::get('password/request', 'PasswordController@showRequestForm')->name('password.request');
Route::post('password/email', 'PasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'PasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'PasswordController@reset')->name('password.update');
