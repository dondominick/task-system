<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\LeaveRequest;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    public function createLeave(Request $request)
    {
        $fields =  $request->validate([
            "leave_title" => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required', 'after_or_equal:start_date'],
            'leave_text' => ['required'],
        ]);
        $fields['start_date'] = date_create($fields['start_date']);
        $fields['end_date'] = date_create($fields['end_date']);

        $fields['user_id'] = Auth::id();

        Notification::create([
            "user_id" => User::where('status', 'admin')->get()->first()->id,
            "to_whom" => 'admin',
            "notif_title" => "New Leave Request: Pending",
            "notif_body" => Auth::user()->name . " has submitted a leave request. Please view the request",
            "notif_summary" => "Leave Request pending",

        ]);

        Notification::create([
            "user_id" => Auth::id(),
            "notif_title" => "Leave Request: Pending",
            "notif_body" => "You have submitted a leave request. Please wait for further updates.",
            "notif_summary" => "Leave Request pending",

        ]);
        LeaveRequest::create($fields);

        return back()->with(['leave' => 'Leave Request submitted successfully']);
    }

    public function updateRequest(Request $request)
    {
        $request->validate([
            'request_id' => ['required', 'exists:leave_requests,id'],
            "request_status" => ['required']
        ]);
        $leave = LeaveRequest::where('id', $request->request_id);
        $raw = $leave->get()->first();
        $leave->update([
            "leave_status" => $request->request_status,
        ]);

        Notification::create([
            "user_id" => $raw->user_id,
            "notif_title" => "Leave Request:" . $request->request_status,
            "notif_body" => "Your leave request has been reviewed by the admin. Your request has been " . $request->request_status,
            "notif_summary" => "Leave Request " . $request->request_status,

        ]);

        return back()->with(['leave' => "Leave request status updated"]);
    }
}
