<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function  viewHome()
    {
        return view('pages.home');
    }

    public function viewTasks()
    {
        return view('pages.tasks');
    }

    public function viewLeave()
    {
        return view('pages.leave');
    }
    public function viewInbox()
    {
        return view('pages.inbox');
    }
}
