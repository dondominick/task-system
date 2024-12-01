<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


// VIEW ROUTES / GET ROUTES

Route::get('/home', [UserController::class, 'viewHome'])->name('home'); // VIEW HOME PAGE / DASHBOARD PAGE
Route::get('/tasks', [UserController::class, 'viewTasks'])->name('tasks'); // VIEW TASK PAGE
Route::get('/leave-request', [UserController::class, 'viewLeave'])->name('leave'); // VIEW LEAVE REQUEST PAGE
Route::get('/inbox', [UserController::class, 'viewInbox'])->name('inbox'); // VIEW INBOX
Route::view('/create-leave', 'pages.create-request')->name('create-leave'); // Create Leave Request

// POST ROUTES
