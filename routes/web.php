<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Comment;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\StatusMiddleware;
use App\Models\Department;
use App\Models\LeaveRequest;
use App\Models\Submission;
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


    Route::get('/', [UserController::class, 'viewHome']);
    // VIEW ROUTES / GET ROUTES

    Route::get('/home', [UserController::class, 'viewHome'])->name('home'); // VIEW HOME PAGE / DASHBOARD PAGE
    Route::get('/tasks', [UserController::class, 'viewTasks'])->name('tasks'); // VIEW TASK PAGE
    Route::get('/leave-request', [UserController::class, 'viewLeave'])->name('leave'); // VIEW LEAVE REQUEST PAGE
    Route::get('/inbox', [UserController::class, 'viewInbox'])->name('inbox'); // VIEW INBOX
    Route::view('/create-leave', 'pages.create-request')->name('create-leave'); // Create Leave Request
    Route::get('/tasks/{id}', [UserController::class, 'viewTask'])->name('task-detail');
    Route::post('/tasks/{id}', [SubmissionController::class, 'create']);
    Route::post('/create-leave', [LeaveRequestController::class, 'createLeave']);
    // CHARTS DATA PASSING

    Route::middleware([StatusMiddleware::class])->group(function () {

        // POST ROUTES
        Route::post('/tasks/create-new', [TaskController::class, 'createTask']);


        // Admin Temporary Routes-
        Route::get('/admin', [AdminController::class, 'displayDashboard'])->name('admin');
        Route::get('/admin/tasks', [AdminController::class, 'displayTasks'])->name('admin-task');
        Route::get('/admin/tasks/create-new', [AdminController::class, 'createNewTask'])->name('create-task');
        Route::get('/admin/leave-requests', [AdminController::class, 'displayRequest'])->name('admin-request');
        Route::get('/admin/department', [AdminController::class, 'displayDepartment'])->name('department');
        Route::get('/admin/users', [AdminController::class, 'displayUsers'])->name('admin-users');
        Route::get('/admin/notifications', [AdminController::class, 'displayNotifications'])->name('admin-notif');
        Route::get('admin/tasks/{id}', [AdminController::class, 'displayTask'])->name('task-details');


        Route::get('/admin/tasks/submissions/{name}', [SubmissionController::class, 'downloadFile']);
        Route::get('/admin/tasks/{name}', [SubmissionController::class, 'downloadFile'])->name('download-file');

        // Admin Post Routes
        Route::post('/admin/department', [DepartmentController::class, 'create']);
        Route::post('/admin/users', [EmployeeController::class, 'create']);
        Route::post('/admin/tasks/create-new', [TaskController::class, 'createTask']);
        Route::post('/admin/tasks/{id}', [Comment::class, 'create']);
        // Admin Patch Routes
        Route::patch('/admin/department', [DepartmentController::class, 'update']);
        Route::patch('/admin/users', [EmployeeController::class, 'update']);
        Route::patch('/admin/leave-requests', [LeaveRequestController::class, 'updateRequest']);
        Route::patch('/admin/tasks/{id}', [SubmissionController::class, 'update']);

        // Admin Delete Routes
        Route::delete('/admin/department', [DepartmentController::class, 'delete']);
        Route::delete('/admin/users', [EmployeeController::class, 'delete']);
    });
});

// 