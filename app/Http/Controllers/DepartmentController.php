<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function create(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required'],
        ]);
        NotificationController::class::create(
            [
                "user_id" => Auth::id(),
                "notif_summary" => "
                    A new department has been created, " . $fields['name'] . "

                ",
                "notif_title" => "A New Department",
                "notif_body" => "
                A new department has been created, " . $fields['name'] . " has been created by "
                    . Auth::user()->name . " 
                ",
                "to_whom" => "admin",
            ]
        );

        Department::create([
            "dept_name" => $request->name,
        ]);
        return back()->with(['department' => "Department added successfully"]);
    }

    public function delete(Request $request)
    {
        dd('delete is working');
    }

    public function update(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required'],
        ]);

        $dept = Department::where('id', $request->dept_id);
        $data = $dept->get()->first();
        NotificationController::class::create(
            [
                "user_id" => Auth::id(),
                "notif_summary" => "
                    A department has been updated

                ",
                "notif_title" => "Department Update",
                "notif_body" => "
                A department has been updated, " . $data->name . " into " . $fields['name'] . " by "
                    . Auth::user()->name . "
                ",
                "to_whom" => "admin",
            ]
        );
        $dept->update($fields);
        return back()->with(["department" => "Department update successfully"]);
    }
}
