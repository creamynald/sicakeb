<?php

use App\Http\Controllers\backend\dashboardController;
use App\Http\Controllers\backend\opdController;
use App\Http\Controllers\backend\opd\pegawaiController;
use App\Http\Controllers\backend\opd\TujuanController;
use App\Http\Controllers\backend\opd\SasaranController;
use App\Http\Controllers\backend\opd\ProgramController;
use App\Http\Controllers\backend\opd\KegiatanController;
use App\Http\Controllers\backend\opd\SubkegiatanController;
use App\Http\Controllers\backend\rolesAndPermission\rolesController;
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

Route::get('/', function () {
    return redirect('/login');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// backend
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('dashboard', [dashboardController::class, 'index']);

    // for admin only
    Route::group(['middleware' => ['role:Super-Admin|admin']], function () {
        Route::resource('opd', opdController::class);
        // begin:additional route (!= resource)
        Route::get('opd/get-data/{id}', [opdController::class, 'getData']);
        Route::post('opd/save', [opdController::class, 'saveData']);
        // end:additional route
    });

    // begin::pegawai controller that can be access by super admin and admin only
    Route::group(['middleware' => ['role:Super-Admin|admin']], function () {
        Route::resource('pegawai', pegawaiController::class);
        // begin:additional route (!= resource)
        Route::post('pegawai/save', [pegawaiController::class, 'saveData']);
        // end:additional route
    });
    // end::pegawai controller

    // begin::tujuan controller that can be access by super admin and admin only
    Route::group(['middleware' => ['role:Super-Admin|admin']], function () {
        Route::resource('tujuan', TujuanController::class);
        // begin:additional route (!= resource)
        Route::post('tujuan/save', [TujuanController::class, 'saveData']);
        // end:additional route
    });
    // end::tujuan controller

    // begin::sasaran controller that can be access by super admin and admin only
    Route::group(['middleware' => ['role:Super-Admin|admin']], function () {
        Route::resource('sasaran', SasaranController::class);
        // begin:additional route (!= resource)
        Route::post('sasaran/save', [SasaranController::class, 'saveData']);
        // end:additional route
    });
    // end::sasaran controller

    // begin::program controller that can be access by super admin and admin only
    Route::group(['middleware' => ['role:Super-Admin|admin']], function () {
        Route::resource('program', ProgramController::class);
        // begin:additional route (!= resource)
        Route::post('program/save', [ProgramController::class, 'saveData']);
        // end:additional route
    });
    // end::program controller

    // begin::kegiatan controller that can be access by super admin and admin only
    Route::group(['middleware' => ['role:Super-Admin|admin']], function () {
        Route::resource('kegiatan', KegiatanController::class);
        // begin:additional route (!= resource)
        Route::post('kegiatan/save', [KegiatanController::class, 'saveData']);
        // end:additional route
    });
    // end::kegiatan controller

    // begin::subkegiatan controller that can be access by super admin and admin only
    Route::group(['middleware' => ['role:Super-Admin|admin']], function () {
        Route::resource('subkegiatan', SubkegiatanController::class);
        // begin:additional route (!= resource)
        Route::post('subkegiatan/save', [SubkegiatanController::class, 'saveData']);
        // end:additional route
    });
    // end::subkegiatan controller

    // for super admin only
    Route::group(['middleware' => ['role:Super-Admin']], function () {
        // roles and permission
        Route::resource('roles', rolesController::class);
    });
});
