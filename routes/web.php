<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

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

Route::get('/', [DashboardController::class, 'index']);

Route::get('tambah', [DashboardController::class, 'tambah'])->name('tambah');
Route::post('tambah', [DashboardController::class, 'store']);

Route::get('edit/{nrp}', [DashboardController::class, 'edit'])->name('edit');
Route::put('update/{nrp}', [DashboardController::class, 'update'])->name('update');

Route::delete('delete/{nrp}', [DashboardController::class, 'destroy'])->name('mahasiswa.destroy');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('handle-form', [AuthController::class, 'handleForm'])->name('auth.handle');
Route::post('register', [AuthController::class, 'register'])->name('register');