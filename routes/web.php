<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HC\AturJadwallController;
use App\Http\Controllers\HC\BobotPenilaiController;
use App\Http\Controllers\HC\GResponseController;
use App\Http\Controllers\HC\HasilPersonalController;
use App\Http\Controllers\HC\IndikatorController;
use App\Http\Controllers\HC\RekapBobotController;
use App\Http\Controllers\HC\RekapNonBobotController;
use App\Http\Controllers\HC\RelasiKaryawan;
use App\Http\Controllers\HC\ResponseController;
use App\Http\Controllers\HC\ScoreJawabanController;
use App\Http\Controllers\HC\ScoresController;
use App\Http\Controllers\HC\SkorController;
use App\Http\Controllers\HC\AspekController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResultController;
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

Route::middleware(['auth', 'hc'])->group(function () {
    Route::controller(ResponseController::class)->group(function () {
        Route::get('/response', 'index')->name('response');

        Route::post('/response/calculate', 'calculate_dp3')->name('response/calculate');

        Route::get('/response/detail/{npp}', 'detail')->name('response/detail');
        Route::post('/response/detail/store', 'store_detail')->name('response/detail/store');
        Route::post('/response/detail/delete/{id}', 'delete_detail')->name('response/detail/delete');

        Route::post('/response/import', 'import')->name('response/import');

        Route::get('/response/report/{npp}', 'report')->name('response/report');
    });

    Route::controller(AturJadwallController::class)->group(function () {
        Route::get('/aturjadwal', 'index')->name('aturjadwal');
        Route::post('/aturjadwal/store', 'store')->name('aturjadwal/store');
    });

    Route::controller(SkorController::class)->group(function () {
        Route::get('/skor', 'index')->name('skor');
        Route::get('/skor/pool/self', 'index_pool_self')->name('skor-index-pool-self');
        Route::get('/skor/pool/atasan', 'index_pool_atasan')->name('skor-index-pool-atasan');
        Route::get('/skor/pool/rekanan', 'index_pool_rekanan')->name('skor-index-pool-rekanan');
        Route::get('/skor/pool/staff', 'index_pool_staff')->name('skor-index-pool-staff');
        Route::get('/skor-pool-self{refresh?}', 'pool_self')->name('skor-pool-self');
        Route::get('/skor-pool-atasan{refresh?}', 'pool_atasan')->name('skor-pool-atasan');
        Route::get('/skor-pool-rekanan{refresh?}', 'pool_rekanan')->name('skor-pool-rekanan');
        Route::get('/skor-pool-staff{refresh?}', 'pool_staff')->name('skor-pool-staff');
        
        Route::post('/skor/store-ajax', 'storeAjax')->name('skor-store-ajax');
    });

    Route::controller(AspekController::class)->group(function() {
        Route::post('/aspek/store', 'store')->name('aspek-store');
    });

    Route::controller(IndikatorController::class)->group(function() {
        Route::get('/indikator/getajax/{id}', 'getAjax')->name('indikator-get-ajax');
        Route::post('/indikator/store', 'store')->name('indikator-store');
    });

    Route::controller(GResponseController::class)->group(function() {
        Route::get('/gform', 'index')->name('gform');
        Route::get('/gform/pull', 'pull')->name('gform-pull'); // Button btnPullResponse
        // Route::get('gform/populate', 'populate')->name('gform-populate');
    });

    Route::controller(RelasiKaryawan::class)->group(function() {
        Route::get('/relasi-karyawan', 'index')->name('relasi-karyawan');
        Route::get('/relasi-karyawan/pull', 'pull')->name('relasi-karyawan-pull');
        Route::get('/relasi-karyawan/pull-level', 'pull_level')->name('relasi-karyawan-pull-level');
    });

    Route::controller(RekapNonBobotController::class)->group(function(){
        Route::get('/rekap/kepemimpinan', 'index')->name('rekap-non-bobot-kepemimpinan');
        Route::get('/rekap/perilaku', 'index_perilaku')->name('rekap-non-bobot-perilaku');
        Route::get('/rekap/sasaran', 'index_sasaran')->name('rekap-non-bobot-sasaran');

        Route::get('/rekap/get-kepemimpinan{refresh?}', 'rekap_kepemimpinan')->name('rekap-get-kepemimpinan');
        Route::get('/rekap/get-perilaku{refresh?}', 'rekap_perilaku')->name('rekap-get-perilaku');
        Route::get('/rekap/get-sasaran{refresh?}', 'rekap_sasaran')->name('rekap-get-sasaran');
    });

    Route::controller(RekapBobotController::class)->group(function(){
        Route::get('/rekap/bobot/kepemimpinan', 'index_kepemimpinan')->name('rekap-bobot-kepemimpinan');
        Route::get('/rekap/bobot/perilaku', 'index_perilaku')->name('rekap-bobot-perilaku');
        Route::get('/rekap/bobot/sasaran', 'index_sasaran')->name('rekap-bobot-sasaran');

        Route::get('/rekap/get-bobot-kepemimpinan{refresh?}', 'rb_kepemimpinan')->name('rekap-get-bobot-kepemimpinan');
        Route::get('/rekap/get-bobot-perilaku{refresh?}', 'rb_perilaku')->name('rekap-get-bobot-perilaku');
        Route::get('/rekap/get-bobot-sasaran{refresh?}', 'rb_sasaran')->name('rekap-get-bobot-sasaran');
    });

    // Route::controller(BobotPenilaiController::class)->group(function(){
    //     Route::get('/bobotpenilai', 'index')->name('bobotpenilai');
    //     Route::post('/bobotpenilai/store-ajax-bobot', 'storeAjaxBobot')->name('skor-store-ajax-bobot');
    // });

    Route::controller(HasilPersonalController::class)->group(function(){
        Route::get('/rekap/personal', 'index')->name('rekap-personal');
        Route::get('/rekap/personal-calculate', 'calculate')->name('rekap-personal-calculate');
        Route::get('/rekap/hasil-personal{detail?}', 'getDetailAjax')->name('rekap-ajax-personal-detail');
        Route::get('/rekap/hasil-personal/penilai{detail?}', 'getPenilaiDetailAjax')->name('rekap-ajax-personal-penilai-detail');
        Route::get('/rekap/hasil-personal/status{dinilai?}{penilai?}', 'checkStatus')->name('rekap-ajax-personal-dinilai-penilai');
        Route::get('/rekap/hasil-personal/follow-up{dinilai?}{penilai?}', 'followUp')->name('rekap-ajax-follow-up');
    });

    // Route::controller(ScoreJawabanController::class)->group(function() {
    //     Route::post('/score-store', 'storeAjax')->name('score-ajax');
    // });

    // Route::controller(ScoresController::class)->group(function () {
    //     Route::get('/score/table', 'index')->name('score.index');
    // });


});

Route::middleware('guest')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/', 'index')->name('login');
        Route::post('/authenticate', 'authenticate')->name('login/authenticate');
    });

    Route::controller(RegisterController::class)->group(function () {
        Route::get('register', 'index')->name('register');

        Route::post('register/create', 'create')->name('register/create');

        Route::post('register/check', 'check')->name('register/check');
    });

    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get('forgot', 'index')->name('forgot');

        Route::post('forgot/send', 'send')->name('forgot/send');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [LogoutController::class, 'logout'])->name('logout');

    Route::controller(HomeController::class)->group(function () {
        Route::get('self', 'index')->name('self');
        Route::get('atasan', 'index')->name('atasan');
        Route::get('selevel', 'index')->name('selevel');
        Route::get('staff', 'index')->name('staff');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'index')->name('profile');

        Route::patch('profile/update/{user}', 'update')->name('profile/update');

        Route::patch('profile/update_photo/{user}', 'update_photo')->name('profile/update_photo');

        Route::patch('profile/update_password/{user}', 'update_password')->name('profile/update_password');
    });
});
