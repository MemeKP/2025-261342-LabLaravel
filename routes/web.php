<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DiaryEntryController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\LinkEntryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route to show the bio page
    Route::get('/profile/bio', [UserController::class, 'showBio'])->name('profile.show-bio');
    Route::resource('diary', DiaryEntryController::class); //add this line
    // Route to handle updating the bio
    Route::patch('/profile/bio', [UserController::class, 'updateBio'])->name('profile.update-bio');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route to handle social media links
    Route::resource('link', LinkEntryController::class);
    // Route to handle reminder
    Route::resource('reminder', ReminderController::class);
    // Route for query Builder: Sad but happy
    Route::get('/sad-but-happy', [DiaryEntryController::class, 'getConflict'])->name('getConflict');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/photo/update', [UserController::class, 'updateProfilePhoto'])->name('profile.photo.update');
    Route::get('/profile/photo/{filename}', [UserController::class, 'showProfilePhoto'])->where('filename', '.*')->name('user.photo');
});

require __DIR__.'/auth.php';
