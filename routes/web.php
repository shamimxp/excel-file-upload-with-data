<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\EmployeeController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/import-form', [EmployeeController::class, 'importForm'])->name('file-import');
Route::post('/import', [EmployeeController::class, 'import'])->name('import');

//activity log

Route::get('login-activity', [ActivityLogController::class, 'getLoginActivity'])->name('login-activity');
Route::get('activity-log-clean-by-name', [ActivityLogController::class, 'cleanLoginActivity'])->name('activity-log-clean-by-name');
Route::get('admin-activity', [ActivityLogController::class, 'getAdminActivity'])->name('admin-activity');
Route::get('view-admin-activity/{id}', [ActivityLogController::class, 'viewAdminActivity'])->name('view-admin-activity');
Route::post('revert-all-admin-activity/{id}', [ActivityLogController::class, 'revertAllAdminActivity'])->name('revert-all-admin-activity');
Route::post('revert-admin-activity/{id}', [ActivityLogController::class, 'revertAdminActivity'])->name('revert-admin-activity');
