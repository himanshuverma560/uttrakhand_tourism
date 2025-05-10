<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AadhaarController;
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
    Route::get('add/pilgrim/{id}', [WebsiteController::class, 'addPligrim'])->name('addPligrim');
    Route::get('edit/pilgrim/{id}', [WebsiteController::class, 'editPligrim'])->name('editPligrim');
    Route::post('update/pilgrim/{id}', [WebsiteController::class, 'updatePligrim'])->name('updatePligrim');
    Route::post('add/pilgrim/{id}', [WebsiteController::class, 'createPligrim'])->name('createPligrim');
    Route::get('download', [WebsiteController::class, 'download'])->name('download');
    Route::post('create/tour', [WebsiteController::class, 'storeTour'])->name('store.tour');
    Route::get('/tour/edit/{id}', [WebsiteController::class, 'editTour'])->name('tour.edit');
    Route::post('/tour/update/{id}', [WebsiteController::class, 'updateTour'])->name('tour.update');
    Route::get('logout', [UserAuthController::class, 'logout'])->name('logout');

    //aadhar card
    Route::post('/aadhaar/generate-otp', [AadhaarController::class, 'generateOtp'])->name('aadhaar.generate');
    Route::post('/aadhaar/verify-otp', [AadhaarController::class, 'verifyOtp'])->name('aadhaar.verify');

});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});