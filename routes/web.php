<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    Route::resource('announcements', \App\Http\Controllers\AnnouncementController::class);
    Route::patch('announcements/{announcement}/pin', [\App\Http\Controllers\AnnouncementController::class, 'togglePin'])->name('announcements.pin');
    Route::patch('announcements/{announcement}/archive', [\App\Http\Controllers\AnnouncementController::class, 'toggleArchive'])->name('announcements.archive');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/bulletin', [\App\Http\Controllers\StudentController::class, 'index'])->name('bulletin');
    Route::get('/bulletin/{announcement}', [\App\Http\Controllers\StudentController::class, 'show'])->name('bulletin.show');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
