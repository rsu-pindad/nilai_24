<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Livewire\Sdm\GoogleRespon;
use App\Livewire\Sdm\RekapDp3ExStaff;
use App\Livewire\Sdm\RekapRespon;
use App\Livewire\Sdm\RelasiKaryawan;
use App\Livewire\Sdm\Skor;
use App\Livewire\Sdm\SkorRespon;
use App\Livewire\Sdm\UserMgmt;
use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider and all of them will
 * | be assigned to the "web" middleware group. Make something great!
 * |
 */

Route::middleware('auth')->group(function () {
    Route::get('logout', [LogoutController::class, 'logout'])->name('logout');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'index')->name('profile');
        Route::patch('profile-update/{user}', 'update')->name('profile-update');
        Route::patch('profile-update-photo/{user}', 'update_photo')->name('profile-update-photo');
        Route::patch('profile-update-password/{user}', 'update_password')->name('profile-update-password');
    });

    Route::middleware('hc')->group(function () {
        // Livewire Route
        Route::controller(Skor::class)->group(function () {
            Route::get('/skor', Skor::class)->name('skor');
            // Route::get('/skor-indikator', [Skor::class, 'selectIndikator'])->name('skor-get-indikator');
        });
        Route::controller(UserMgmt::class)->group(function () {
            Route::get('/user-mgmt', UserMgmt::class)->name('user-mgmt');
        });
        Route::controller(RelasiKaryawan::class)->group(function () {
            Route::get('/relasi-karyawan', RelasiKaryawan::class)->name('relasi-karyawan');
        });
        Route::controller(GoogleRespon::class)->group(function () {
            Route::get('/respon', GoogleRespon::class)->name('google-respon');
        });
        Route::controller(SkorRespon::class)->group(function () {
            Route::get('/skor-respon', SkorRespon::class)->name('skor-respon');
        });
        Route::controller(RekapRespon::class)->group(function () {
            Route::get('/rekap-respon', RekapRespon::class)->name('rekap-respon');
            Route::get('/rekap-dp-except-staff', RekapDp3ExStaff::class)->name('rekap-dp-except-staff');
        });
        // End Livewire route
    });
});

Route::middleware('guest')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/', 'index')->name('login');
        Route::post('/authenticate', 'authenticate')->name('login-authenticate');
    });

    Route::controller(RegisterController::class)->group(function () {
        Route::get('register', 'index')->name('register');
        Route::post('register-create', 'create')->name('register-create');
        Route::post('register-check', 'check')->name('register-check');
    });

    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get('forgot', 'index')->name('forgot');
        Route::post('forgot-send', 'send')->name('forgot-send');
    });
});
