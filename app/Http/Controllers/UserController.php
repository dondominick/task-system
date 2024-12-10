<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\Notification;
use App\Models\Submission;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function  viewHome()
    {
        $notifications = Notification::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $tasks = Task::where('employee_assigned', session('employee')->id)->Orwhere('employee_assigned', 'everyone')->get();

        return view('pages.home', compact('tasks', 'notifications'));
    }

    public function viewTasks()
    {
        $task = Task::select('*')->where('employee_assigned', session('employee')->id)->orWhere('employee_assigned', 'everyone')->orderBy('end_date', 'desc')->get();
        return view('pages.tasks', ['tasks' => $task]);
    }

    public function viewTask($id)
    {
        $task = Task::where('id', $id)->get()->first();
        $employee = Employee::where('user_id', Auth::id())->get()->first();
        $submission = Submission::where('task_id', $task->id)->where('employee_id', $employee->id)->get()->first();
        $comments = Comments::where('sub_id', $submission->id)->get();
        if ($comments != null) {
            $comments = $comments->first();
        }
        return view('pages.task-details', ['task' => $task, 'comments' => $comments]);
    }
    public function viewLeave()
    {
        $request = LeaveRequest::where('user_id', Auth::id())->get();
        return view('pages.leave', compact('request'));
    }
    public function viewInbox()
    {
        $notifications = Notification::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('pages.inbox', compact('notifications'));
    }
}
