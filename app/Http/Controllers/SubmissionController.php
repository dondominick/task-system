<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Notification;
use App\Models\Submission;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{

    public function create(Request $request)
    {
        $fields = $request->validate([
            "status" => ['required'],
            "task_id" => ['required'],
            "employee_id" => ['required'],

        ]);
        $filePath = null;

        if ($request->has('require_submission')) {
            $request->validate([
                "file" => ['required']
            ]);
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filePath = $file->store('submissions', 'public'); // Save to the "storage/app/public/uploads" directory


            }
        }
        $fields['file'] = $filePath;
        $fields['sub_date'] = date('d/m/y');
        $data = Employee::select('id')->where('user_id', $request->employee_id)->get()->first();

        $fields['employee_id'] = $data->id;

        Submission::create($fields);
        $task = Task::where('id', $request->task_id);

        $task->update([
            "status" => "submitted"
        ]);
        $data = $task->get()->first();
        $admin = User::where('status', 'admin')->get()->first();
        Notification::create([
            "user_id" => $admin->id,
            "notif_title" => "New Submission: $data->task_name",
            "to_whom" => "admin",
            "notif_body" => "User " . Auth::user()->name . " has submitted his task. Please review his/her submission of the task.",
            "notif_summary" => "A user has submitted his/her task. Please review the submission",
        ]);

        Notification::create([
            "user_id" => Auth::id(),
            "notif_title" => "New Submission: $data->task_name",
            "notif_body" => "You have submitted your task. Please wait as the admin is still reviewing your submission.",
            "notif_summary" => "Submission successful.",
        ]);


        return redirect()->route('tasks')->with(['tasks' => "Task submitted successfully"]);
    }


    public function downloadFile($name)
    {
        $path = Storage::path("submissions/$name");
        return response()->download($path);

        if (!Storage::exists("public/$name")) {
            return back()->withErrors(["file" => "File not Found"]);
        }

        return Storage::download("public/storage/$name");
    }
}
