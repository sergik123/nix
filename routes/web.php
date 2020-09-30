<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
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
Route::get('/users', function () {
    return view('users');
});


Auth::routes(['verify' => true]);

Route::get('/',[IndexController::class, 'main'])->middleware('verified')->name('home');

/*Route::get('/login', function () {
    return view('welcome');
});*/

/*Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');
*/
