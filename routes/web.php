<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RuleController;
use App\Http\Controllers\Admin\ParameterController;
use App\Http\Controllers\Admin\TanamanController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Redirect root ke /login
Route::get('/', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

// // Dashboard admin
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

// Dashboard user biasa
Route::get('/home', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');


// Gallery route
Route::get('/galery', [App\Http\Controllers\GaleryController::class, 'index'])->middleware(['auth', 'verified'])->name('galery');
Route::get('/tanaman/{id}', [App\Http\Controllers\GaleryController::class, 'show'])->middleware(['auth', 'verified'])->name('tanaman.detail');

// User recommendation routes
Route::middleware(['auth'])->group(function () {
    Route::get('/rekomendasi', [App\Http\Controllers\RecommendationController::class, 'index'])->name('rekomendasi');
    Route::post('/rekomendasi/process', [App\Http\Controllers\RecommendationController::class, 'process'])->name('rekomendasi.process');
    Route::get('/rekomendasi/history', [App\Http\Controllers\RecommendationController::class, 'history'])->name('rekomendasi.history');
});


// Gabungkan semua route admin di sini:
Route::middleware(['auth','admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard
        // Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
        // AJAX untuk fuzzy Mamdani
        Route::get('/rules/tanaman-list', [RuleController::class, 'getAllTanaman'])->name('rules.tanaman-list');
        // CRUD resources
        Route::resource('rules', RuleController::class);
        Route::resource('parameter', ParameterController::class);
        Route::resource('tanaman', TanamanController::class);
        // Parameter by-type
        Route::get('/parameter/{type}/edit-by-type', [ParameterController::class,'editByType'])
             ->name('parameter.editByType');
        Route::put('/parameter/{type}/update-by-type', [ParameterController::class,'updateByType'])
             ->name('parameter.updateByType');
        Route::delete('/parameter/{type}/delete-by-type', [ParameterController::class,'deleteByType'])
             ->name('parameter.deleteByType');
        Route::get('/recommendations', [RuleController::class,'getRecommendations'])
             ->name('recommendations');
        Route::get('/debug-tanaman', [RuleController::class,'debugTanaman'])
             ->name('debug-tanaman');
    });

// Profile & auth …


// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // // Recommendation history - Fix the controller reference
    // Route::get('/history', [App\Http\Controllers\RecommendationController::class, 'history'])->name('rekomendasi.history');
});
require __DIR__.'/auth.php';
