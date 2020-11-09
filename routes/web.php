<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\URL;

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
Route::get('/', [IndexController::class, 'main'])->name('home');
Route::get('/search',  [IndexController::class, 'search'])->name('search');
Route::get('/filter', [IndexController::class, 'filter'])->name('filter');
Route::get('/users', [UsersController::class, 'users'])->name('users');
Route::post('/change', [UsersController::class, 'change']);
Route::post('/add', [UsersController::class, 'add']);
Route::get('/search_user',  [UsersController::class, 'search']);
Route::get('/filter_user', [UsersController::class, 'filter']);

Route::post('/changebook', [BooksController::class, 'change']);
Route::post('/addbook', [BooksController::class, 'add']);


Route::get('login/{website}', [LoginController::class, 'redirectToProvider']);
Route::get('login/{website}/callback', [LoginController::class, 'handleProviderCallback']);


Auth::routes(['verify' => true]);

Route::get('/',[IndexController::class, 'main'])->middleware('verified')->name('home2');


/*Route::get('/login', function () {
    return view('welcome');
});*/

/*Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');
*/

//Auth::routes();

Route::get('/home', [App\Http\Controllers\IndexController::class, 'main'])->middleware('verified')->name('home3');
Route::get('/{any}', function () {
    return view('home');
})->where('any', '.*');
