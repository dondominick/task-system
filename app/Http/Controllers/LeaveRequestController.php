<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    public function createLeave(Request $request)
    {
        $fields =  $request->validate([
            "title" => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required', 'after_or_equal:start_date'],
            'description' => ['required'],
        ]);
        $fields['start_date'] = date_create($fields['start_date']);
        $fields['end_date'] = date_create($fields['end_date']);

        $fields['user_id'] = Auth::id();
        LeaveRequest::create($fields);

        return back()->with(['leave' => 'Leave Request submitted successfully']);
    }
}
