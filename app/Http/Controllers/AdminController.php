<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\Notification;
use App\Models\Submission;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function displayDashboard()
    {
        // FETCH DATA FROM THE DATABASE FOR TASKS & LEADERBOARDS
        $tasks = Task::all();
        $leaderboard = Submission::select('employee_id', DB::raw('COUNT(*) as submissions'))->groupBy('employee_id')->orderBy('submissions', 'desc')
            ->join('employees', 'employee_id', '=', 'employees.id')
            ->take(3)->get();
        $employee = [];
        foreach ($leaderboard as $employees) {
            $employee[] .= Employee::select('*', 'employees.id')->where('employees.id', $employees->employee_id)
                ->join('departments', 'employees.department_id', '=', 'departments.id')
                ->get()->first();
        }

        // Fetch data from database - SAMPLE
        $raw = Task::select('status', DB::raw('COUNT(*) as task_count'))->groupBy('status')->get();
        $labels = [];
        $data = [];

        // Process The Data
        foreach ($raw as $status) {
            $labels[] .= $status->status;
            $data[] .= $status->task_count;
        }


        return view('admin.dashboard', compact('labels', 'data', 'tasks', 'employee'));
    }

    function displayTasks()
    {
        $tasks = Task::all();
        return view('admin.tasks', ["tasks" => $tasks]);
    }

    function displayRequest()
    {
        $request = LeaveRequest::select('*', 'leave_requests.id')->join('employees', 'employees.user_id', '=', 'leave_requests.user_id')->get();
        return view('admin.leave', ["requests" => $request]);
    }
    function createTask(Request $request)
    {
        dd('working');
    }

    function displayDepartment()
    {
        $dept = Department::all();
        return view('admin.department', ['dept' => $dept]);
    }
    function displayNotifications()
    {
        $notifications = Notification::where("user_id", Auth::id())->Orwhere('to_whom', "admin")->orderBy('created_at', 'desc')->get();
        return view('admin.notification', compact('notifications'));
    }

    function displayUsers()
    {
        $users =  User::select('*')->where('status', 'user')
            ->join('employees', 'users.id', '=', 'employees.user_id')
            ->get();
        $dept = Department::all();
        return view('admin.users', ["users" => $users, "depts" => $dept]);
    }

    public function createNewTask()
    {
        $users = Employee::all();

        return view('admin.new-task', ["employees" => $users]);
    }
    public function displayTask($id)
    {

        $task = Task::where('id', $id)->get()->first();
        $submissions = Submission::select('*', 'submissions.id')->where('task_id', $id)->join('employees', 'submissions.employee_id', '=', 'employees.id')->get();
        return view('admin.submissions', compact('task', 'submissions'));
    }
}
