<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::middleware('guest')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/', 'index')->name('login');
        Route::post('/authenticate', 'authenticate')->name('login/authenticate');
    });

    Route::controller(RegisterController::class)->group(function () {
        Route::get('register', 'index')->name('register');

        Route::post('register/create', 'create')->name('register/create');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [LogoutController::class, 'logout'])->name('logout');

    Route::controller(HomeController::class)->group(function () {
        Route::get('self', 'index')->name('self');
        Route::get('atasan', 'index')->name('atasan');
        Route::get('selevel', 'index')->name('selevel');
    });

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
});
