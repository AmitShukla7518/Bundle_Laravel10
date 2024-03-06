<?php

use App\Http\Controllers\EliteCallbackabandonedController;
use App\Http\Controllers\EliteCallBackController;
use App\Http\Controllers\StandardCallbackabandonedController;
use App\Http\Controllers\StandardCallBackController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsermanagementController;
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

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
});

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // USER MANAGEMENT
    Route::get('/users/list', [UsermanagementController::class, 'index'])->name('users');
    Route::get('/users/create', [UsermanagementController::class, 'add'])->name('adduser');
    Route::post('/users/store', [UsermanagementController::class, 'create'])->name('users.create');
    Route::get('/users/edit/{id}', [UsermanagementController::class, 'edit'])->name('users.edit');
    Route::post('/users/update', [UsermanagementController::class, 'update'])->name('users.update');
    Route::get('/users/delete/{id}', [UsermanagementController::class, 'delete'])->name('users.delete');
    // 












});
