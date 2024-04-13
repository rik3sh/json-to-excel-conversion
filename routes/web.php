<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GithubAuthController;

// Route::view('/', 'welcome');
Route::get('/', [GithubAuthController::class, 'welcome'])->name('welcome')->middleware('guest');


Route::get('/auth/redirect', [GithubAuthController::class, 'redirect'])->name('github.auth.redirect');
Route::get('/auth/callback', [GithubAuthController::class, 'callback'])->name('github.auth.callback');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    
    // File Routes
    Route::get('/upload', [FileController::class, 'create'])->name('upload');
    Route::post('/upload', [FileController::class, 'store'])->name('upload.store');
    Route::get('/download/{path}', [FileController::class, 'download'])->name('download');

    Route::post('/auth/logout', [GithubAuthController::class, 'logout'])->name('github.auth.logout');
});