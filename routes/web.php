<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexTrapSpeedController;
use App\Http\Controllers\IndexTurboSizingController;
use App\Http\Controllers\IndexInjectorSizeController;
use App\Http\Controllers\IndexCompressionRatioController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('compression-ratio-calculator', IndexCompressionRatioController::class)->name('compression-ratio');
Route::get('turbo-size-calculator', IndexTurboSizingController::class)->name('turbo-sizing');
Route::get('injector-size-calculator', IndexInjectorSizeController::class)->name('injector-size');
Route::get('trap-speed-calculator', IndexTrapSpeedController::class)->name('trap-speed');

Route::get('privacy-policy', function () {
    return Inertia::render('PrivacyPolicy');
})->name('privacy-policy');

Route::get('terms-of-service', function () {
    return Inertia::render('TermsOfService');
})->name('terms-of-service');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
