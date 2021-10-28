<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicationController;

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

//http://127.0.0.1:8000/          root route

/*->middleware('httpget')*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/publication/{slug}', [HomeController::class, 'show'])->name('view-publication');

Route::match(['get', 'post'], 'login', [AuthController::class, 'login'])->name('login');
Route::match(['get', 'post'], 'register', [AuthController::class, 'register'])->name('register');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::name('dashboard.')->prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('publications', PublicationController::class);
    Route::get('publications/{publication}', [PublicationController::class, 'toggleStatus'])->name('publications.toggle-status');

    Route::get('publication/{publication}/images/{image}/primary', [ImageController::class, 'primary'])->name('images.primary');
    Route::get('publication/{publication}/images/{image}/delete', [ImageController::class, 'delete'])->name('images.delete');
});