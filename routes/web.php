<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
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




// START
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('pages.home');
    });
    // VIEW ROUTES / GET ROUTES

    Route::get('/home', [UserController::class, 'viewHome'])->name('home'); // VIEW HOME PAGE / DASHBOARD PAGE
    Route::get('/tasks', [UserController::class, 'viewTasks'])->name('tasks'); // VIEW TASK PAGE
    Route::get('/leave-request', [UserController::class, 'viewLeave'])->name('leave'); // VIEW LEAVE REQUEST PAGE
    Route::get('/inbox', [UserController::class, 'viewInbox'])->name('inbox'); // VIEW INBOX
    Route::view('/create-leave', 'pages.create-request')->name('create-leave'); // Create Leave Request
    Route::view('/tasks/create-new', 'pages.create-task')->name('new-task');
    // POST ROUTES
    Route::post('/tasks/create-new', [TaskController::class, 'createTask']);
    Route::post('/create-leave', [LeaveRequestController::class, 'createLeave']);


    // Admin Temporary Routes-
    Route::get('/admin', [AdminController::class, 'displayDashboard'])->name('admin');
    Route::get('/admin/tasks', [AdminController::class, 'displayTask'])->name('admin-task');
    Route::view('/admin/tasks/create-new', 'admin.new-task')->name('create-task');
    Route::post('/admin/tasks/create-new', [AdminController::class, 'createTask']);
    Route::get('/admin/leave-requests', [AdminController::class, 'displayRequest'])->name('admin-request');
    Route::get('/admin/department', [AdminController::class, 'displayDepartment'])->name('department');
    Route::get('/admin/users', [AdminController::class, 'displayUsers'])->name('admin-users');
    Route::get('/admin/notifications', [AdminController::class, 'displayNotifications'])->name('admin-notif');
    Route::post('/admin/tasks/create-new', [TaskController::class, 'createTask']);
});
