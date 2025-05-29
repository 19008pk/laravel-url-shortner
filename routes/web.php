<?php

use App\Http\Controllers\ApiShortUrlController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShortUrlController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Route::apiResource('short-urls', ApiShortUrlController::class);

Route::middleware(['auth'])->group(function () {
    Route::resource('short-urls', ShortUrlController::class);
    // Route::get('/short-urls', [ShortUrlController::class, 'index'])->name('short-urls.index');
    // Route::post('/short-urls', [ShortUrlController::class, 'store'])->name('short-urls.store');
});

Route::get('/s/{shortCode}', [ShortUrlController::class, 'redirect'])->name('short-urls.redirect');

require __DIR__ . '/auth.php';
