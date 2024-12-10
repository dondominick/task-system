<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Notification;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    function createTask(Request $request)
    {
        $request->validate([
            "task_name" => ['required'],
            "end" => ['required'],
            "start" => ['required'],
            "user" => ['required'],
            "message" => ['required'],
            "require_submission" => ['required', 'boolean']
        ]);
        $filePath = "";
        if ($request->file('task_file')) {
            $file = $request->file('task_file');
            $filePath = $file->store('uploads', 'public'); // Save to the "storage/app/public/uploads" directory

        }

        Task::create([
            "task_name" => $request->task_name,
            "employee_assigned" => $request->user,
            "start_date" => date('d/m/y', strtotime($request->start)),
            "end_date" => date('d/m/y', strtotime($request->end)),
            "description" => $request->message,
            "require_submission" => $request->require_submission,
            "file" => $filePath
        ]);
        if ($request->user == "Everyone") {
            $employee = Employee::where('id', $request->user)->get()->first();

            // ADMIN NOTIFICATION
            Notification::class::create([
                "user_id" => Auth::id(),
                "notif_title" => "A new task has been created",
                "notif_summary" => "$request->task_name has been created",
                "notif_body" => "$request->task_name has been created by " . Auth::user()->name . " and it has been assigned to all employees",
                "to_whom" => "admin"
            ]);

            //    USER NOTIFICATION

            Notification::class::create([
                "user_id" =>  $employee->id,
                "notif_title" => "You have been assigned to a new task",
                "notif_summary" => "$request->task_name has been assigned to you",
                "notif_body" => "$request->task_name has been assigned to you by " . Auth::user()->name . "."
                    . "Due date of this task is " . date('M d, Y', strtotime($request->end)),
                "to_whom" => "user"
            ]);
            return back()->with(["session" => "Task created successfully"]);
        }
        dd($request);
        $employee = Employee::where('id', $request->user)->get()->first();

        // ADMIN NOTIFICATION
        Notification::class::create([
            "user_id" => Auth::id(),
            "notif_title" => "A new task has been created",
            "notif_summary" => "$request->task_name has been created",
            "notif_body" => "$request->task_name has been created by " . Auth::user()->name . " and it has been assigned to employee $employee->firstname $employee->lastname",
            "to_whom" => "admin"
        ]);

        //    USER NOTIFICATION
        Notification::class::create([
            "user_id" => $request->user,
            "notif_title" => "You have been assigned to a new task",
            "notif_summary" => "$request->task_name has been assigned to you",
            "notif_body" => "$request->task_name has been assigned to you by " . Auth::user()->name . "."
                . "Due date of this task is " . date('M d, Y', strtotime($request->end)),
            "to_whom" => "user"
        ]);

        return back()->with(["session" => "Task created successfully"]);
    }
}
