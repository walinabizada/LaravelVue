<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\KBMController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', [PublicController::class, 'index'])->name('welcome');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::group(['middleware' => ['auth', 'isAdmin']], function () {
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'Auth\RegisterController@register');
});

Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    // Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    // Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/kbm', [KBMController::class, 'index'])->name('dashboard.kbm.index');
    Route::get('/kbm/create', [KBMController::class, 'create'])->name('dashboard.kbm.create');
    Route::post('/kbm', [KBMController::class, 'store'])->name('dashboard.kbm.store');
    Route::get('/kbm/{id}/edit', [KBMController::class, 'edit'])->name('dashboard.kbm.edit');
    Route::put('/kbm/{id}', [KBMController::class, 'update'])->name('dashboard.kbm.update');
    Route::delete('/kbm/{id}', [KBMController::class, 'destroy'])->name('dashboard.kbm.destroy');
});



require __DIR__.'/auth.php';
