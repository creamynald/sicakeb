<?php

use App\Http\Controllers\backend\dashboardController;
use App\Http\Controllers\backend\opdController;
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
    return view('welcome');
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

    // for super admin only
    Route::group(['middleware' => ['role:Super-Admin']], function () {
        // roles and permission
        Route::resource('roles', rolesController::class);
    });
});
