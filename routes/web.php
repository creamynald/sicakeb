<?php

use App\Http\Controllers\frontend\frontendController;
use App\Http\Controllers\backend\dashboardController;
use App\Http\Controllers\backend\opdController;
use App\Http\Controllers\backend\opd\pegawaiController;
use App\Http\Controllers\backend\opd\TujuanController;
use App\Http\Controllers\backend\opd\SasaranController;
use App\Http\Controllers\backend\opd\ProgramController;
use App\Http\Controllers\backend\opd\KegiatanController;
use App\Http\Controllers\backend\opd\SubkegiatanController;
use App\Http\Controllers\backend\rolesAndPermission\assignRolePermission;
use App\Http\Controllers\backend\rolesAndPermission\permissionsController;
use App\Http\Controllers\backend\rolesAndPermission\rolesController;
use App\Http\Controllers\backend\rolesAndPermission\userToRoleController;
use App\Http\Controllers\backend\users\userController;
use App\Http\Controllers\backend\perjanjianKinerja\RealisasiController;
use App\Http\Controllers\backend\perjanjianKinerja\TargetController;
use App\Http\Controllers\backend\perjanjianKinerja\CapaianController;
use App\Http\Controllers\backend\dokumen\FileController;
use App\Http\Controllers\backend\dokumen\dokRenaksiController;
use App\Http\Controllers\backend\lhe\LheController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

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

// frontend
Route::get('/', [frontendController::class, 'index']);

// Route::get('/', function () {
//     return redirect('/login');
// });

Auth::routes([
    'register' => false, // Register Routes...

    'reset' => false, // Reset Password Routes...
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/avatars/{filename}', function ($filename) {
    $user = auth()->user();
    if ($user && $user->avatar === $filename) {
        $path = storage_path('app/avatars/' . $filename);
        if (file_exists($path)) {
            return response()->file($path);
        }
    }
    abort(404);
});

// backend
Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('rekap-capaian-opd', [dashboardController::class, 'rekapCapaianOpd'])->name('capaianOpd');
        Route::get('rekap-capaian-pemda', [dashboardController::class, 'rekapCapaianPemda'])->name('capaianPemda');
        Route::get('rekap-capaian-pemda-byid/{opdId}', [dashboardController::class, 'getCapaianPemdaById'])->name('capaianPemdaById');
        // Route::get('persentase-capaian', [dashboardController::class, 'showTargets'])->name('showTargets');
        Route::get('dashboard', [dashboardController::class, 'index']);
        Route::get('/dashboard/activities', [dashboardController::class, 'getActivities'])->name('activities');

        // for admin only
        Route::group(['middleware' => ['role:Super-Admin|admin']], function () {
            Route::resource('opd', opdController::class);
            // begin:additional route (!= resource)
            Route::get('opd/get-data/{id}', [opdController::class, 'getData']);
            Route::post('opd/save', [opdController::class, 'saveData']);
            // end:additional route
        });

        // begin::pegawai controller that can be access by super admin and admin only
        Route::group(['middleware' => ['role:Super-Admin|admin|operator']], function () {
            Route::resource('pegawai', pegawaiController::class);
            // begin:additional route (!= resource)
            Route::post('pegawai/save', [pegawaiController::class, 'saveData']);
            // end:additional route
        });
        // end::pegawai controller

        // begin::tujuan controller that can be access by super admin and admin only
        Route::group(['middleware' => ['role:Super-Admin|admin|operator']], function () {
            Route::resource('tujuan', TujuanController::class);
            // begin:additional route (!= resource)
            Route::post('tujuan/save', [TujuanController::class, 'saveData']);
            // end:additional route
        });
        // end::tujuan controller

        // begin::sasaran controller that can be access by super admin and admin only
        Route::group(['middleware' => ['role:Super-Admin|admin|operator']], function () {
            Route::resource('sasaran', SasaranController::class);
            // begin:additional route (!= resource)
            Route::post('sasaran/save', [SasaranController::class, 'saveData']);
            // end:additional route
        });
        // end::sasaran controller

        // begin::program controller that can be access by super admin and admin only
        Route::group(['middleware' => ['role:Super-Admin|admin|operator']], function () {
            Route::resource('program', ProgramController::class);
            // begin:additional route (!= resource)
            Route::post('program/save', [ProgramController::class, 'saveData']);
            // end:additional route
        });
        // end::program controller

        // begin::kegiatan controller that can be access by super admin and admin only
        Route::group(['middleware' => ['role:Super-Admin|admin|operator']], function () {
            Route::resource('kegiatan', KegiatanController::class);
            // begin:additional route (!= resource)
            Route::post('kegiatan/save', [KegiatanController::class, 'saveData']);
            // end:additional route
        });
        // end::kegiatan controller

        // begin::subkegiatan controller that can be access by super admin and admin only
        Route::group(['middleware' => ['role:Super-Admin|admin|operator']], function () {
            Route::resource('subkegiatan', SubkegiatanController::class);
            // begin:additional route (!= resource)
            Route::post('subkegiatan/save', [SubkegiatanController::class, 'saveData']);
            // end:additional route
        });
        // end::subkegiatan controller

        // for super admin only
        Route::group(['middleware' => ['role:Super-Admin|admin|operator']], function () {
            Route::resource('users', userController::class);
            Route::post('users/save', [userController::class, 'saveData']);
        });

        Route::prefix('setting')->group(function () {
            // edit profile
            Route::get('users/{user}/edit', [userController::class, 'editProfile'])->name('profile.edit');
            Route::put('users/{user}/update', [UserController::class, 'updateProfile'])->name('profile.update');


        });

        // for super admin only
        Route::group(['middleware' => ['role:Super-Admin']], function () {
            // roles and permission
            Route::resource('roles', rolesController::class);
            Route::post('roles/save', [rolesController::class, 'saveData']);

            Route::resource('permissions', permissionsController::class);
            Route::post('permissions/save', [permissionsController::class, 'saveData']);

            Route::resource('assignable', assignRolePermission::class);
            Route::post('assignable/save', [assignRolePermission::class, 'saveData']);

            Route::resource('assign-to-user', userToRoleController::class);
            Route::post('assign-to-user/save', [userToRoleController::class, 'saveData']);
        });

        // begin::target controller that can be access by super admin and admin only
        Route::group(['middleware' => ['role:Super-Admin|admin|operator']], function () {
            Route::get('target/get-data', [TargetController::class, 'getData'])->name('get-data');
            Route::resource('target', TargetController::class);
            // begin:additional route (!= resource)
            Route::post('target/save', [TargetController::class, 'saveData']);
            Route::post('target/data-pegawai', [TargetController::class, 'dataPegawai']);
            Route::get('target/rincian/{id}', [TargetController::class, 'rincianTarget'])->name('rincianTarget');
            // end:additional route
        });
        // end::target controller

        // begin::realisasi controller that can be access by super admin and admin only
        Route::group(['middleware' => ['role:Super-Admin|admin|operator']], function () {
            Route::get('capaian', [RealisasiController::class, 'capaian'])->name('capaian');
            Route::resource('realisasi', RealisasiController::class);
            // begin:additional route (!= resource)
            Route::post('realisasi/save', [RealisasiController::class, 'saveData']);
            Route::post('realisasi/data-pegawai', [RealisasiController::class, 'dataPegawai']);
            Route::get('realisasi/rincian/{id}', [RealisasiController::class, 'rincianRealisasi'])->name('rincianRealisasi');
            // end:additional route
        });
        // end::realisasi controller

        // begin::capaian controller
        Route::group(['middleware' => ['role:Super-Admin|admin|operator']], function () {
            Route::get('capaian', [CapaianController::class, 'index'])->name('capaian');
            Route::get('capaian/rincian/{id}', [CapaianController::class, 'rincianCapaian'])->name('rincianCapaian');
            // end:additional route
        });
        // end::capaian controller

        // begin::dok renaksi controller
        Route::group(['middleware' => ['role:Super-Admin']], function () {
            Route::resource('dok-renaksi', dokRenaksiController::class);
        });

        // for super admin & admin

        // begin::File controller that can be access by super admin and admin only
        Route::group(['middleware' => ['role:Super-Admin|admin|operator']], function () {
            Route::resource('file', FileController::class);
            // begin:additional route (!= resource)
            Route::post('file/save', [FileController::class, 'saveData'])->name('saveData');
            Route::get('/download/{folder}/{filename}', [FileController::class, 'download'])->name('download');
            Route::delete('/file/{id}/{folder}/{filename}', [FileController::class, 'destroy'])->name('destroy');
            // end:additional route
        });
        // end::File controller

        // begin::lhe controller that can be access by super admin and admin only
        Route::group(['middleware' => ['role:Super-Admin|admin|operator']], function () {
            Route::resource('lhe', LheController::class);
            // begin:additional route (!= resource)
            Route::post('lhe/save', [LheController::class, 'saveData']);
            // end:additional route

        });
        // end::lhe controller
    });
