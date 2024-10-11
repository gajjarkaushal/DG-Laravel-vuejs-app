<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\InstallerController;
use App\Http\Controllers\ManagerController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Installer Routes
    Route::resource('installers', InstallerController::class);
    //Manager routes
    // Route::get('/managers', [ManagerController::class, 'index']);
    // Route::post('/managers', [ManagerController::class, 'store']);
    // Route::put('/managers/{manager}', [ManagerController::class, 'update']);    
    // Route::delete('/managers/{id}', [ManagerController::class, 'destroy'])->name('managers.destroy');
    Route::resource('managers', ManagerController::class);

});

Route::resource('/v1/installers-api', App\Http\Controllers\Api\InstallerController::class, [
  'except' => ['edit', 'update', 'destroy']
]);
Route::resource('/v1/managers-api', App\Http\Controllers\API\ManagerController::class, [
  'except' => ['edit', 'update', 'destroy']
]);



require __DIR__.'/auth.php';
