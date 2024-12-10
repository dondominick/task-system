<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{

    public function create(Request $request)
    {

        $fields = $request->validate([
            "firstname" => ['required'],
            "lastname" => ['required'],
            "email" => ['required', 'unique:users', 'email'],
            "department_id" => ['required'],
            "password" => ['required', 'confirmed']
        ]);

        // CREATE USER
        $fields['name'] = $request->firstname . " " . $request->lastname;
        $user = User::create($fields);
        // ADD USER TO THE EMPLOYEE TABLE
        $fields['user_id'] = $user->id;
        $employee = Employee::create($fields);
        $dept = Department::where('id', $request->department_id)->get()->first();

        Notification::class::create([
            "user_id" => Auth::id(),
            "notif_title" => "A new user",
            "notif_body" => "
            Employee $employee->firstname $employee->lastname has been assigned at 
            $dept->dept_name. Admin " . Auth::user()->name . " has added this user to the system.
            ",
            "notif_summary" => "A new user has been added to the system",
            "to_whom" => "admin"

        ]);

        Notification::class::create([
            "user_id" => $user->id,
            "notif_title" => "Welcome to Task System",
            "notif_body" => "
            Welcome to Task System $employee->firstname, You are assigned at 
            $dept->dept_name.
            ",
            "notif_summary" => "Welcome to Task System $employee->firstname!"
        ]);
        return back()->with(["success" => "User created successfully"]);
    }

    public function update(Request $request)
    {
        $fields = $request->validate([
            "firstname" => ['required'],
            "lastname" => ['required'],
            "department_id" => ['required'],

        ]);
        Employee::where('user_id', $request->user_id)->update($fields);

        return back()->with(["success" => "User updated successfully"]);
    }

    public function delete(Request $request)
    {
        dd('delete is working');
    }
}
