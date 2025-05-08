<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\UserAuthController;
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
;

Route::get('/', [WebsiteController::class, 'index'])->name('home');
Route::get('registration', [WebsiteController::class, 'registration'])->name('registration');
Route::post('registration/store', [WebsiteController::class, 'store'])->name('registration.store');

Route::post('login', [UserAuthController::class, 'login'])->name('user.login');
Route::prefix('user')->middleware(['auth'])->group(function () {
    Route::get('dashboard', [WebsiteController::class, 'dashboard'])->name('dashboard');
    Route::get('tour', [WebsiteController::class, 'tour'])->name('tour');
    Route::get('view/tour', [WebsiteController::class, 'viewTour'])->name('viewTour');
    Route::get('add/pilgrim', [WebsiteController::class, 'addPligrim'])->name('addPligrim');
    Route::get('download', [WebsiteController::class, 'download'])->name('download');
    Route::get('logout', [UserAuthController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});