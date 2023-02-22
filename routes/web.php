<?php

use App\Http\Controllers\Admin\ShiftController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::prefix('admin')->name('admin.')->group(function () {
    require __DIR__ . '/admin.php';

    Route::middleware(['auth:admin'])->group(function () {

        // ダッシュボード
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // シフト管理
        Route::prefix('shift')->name('shift.')->controller(ShiftController::class)->group(function () {
            Route::get('/deployment', 'showDeployment')->name('deployment');
            Route::post('/deployment', 'deployment');
            Route::get('/attendance_request', 'showAttendanceRequest')->name('attendance_request');
            Route::post('/attendance_request', 'attendanceRequest');
        });
        Route::resource('shift', ShiftController::class);
    });
});
