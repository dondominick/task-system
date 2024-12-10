<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Comment extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'comment' => ['required'],
        ]);
        Comments::class::create([
            "text" => $request->comment,
            "sub_id" => $request->id,
            "admin_id" => Auth::id(),
            "date" => Carbon::now(),
        ]);

        return back()->with(['comment' => "Comment successfully made"]);
    }
}
