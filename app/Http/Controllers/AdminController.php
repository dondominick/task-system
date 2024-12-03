<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function displayDashboard()
    {

        return view('admin.dashboard');
    }

    function displayTask()
    {
        return view('admin.tasks');
    }

    function displayRequest()
    {
        return view('admin.leave');
    }
    function createTask(Request $request)
    {
        dd('working');
    }

    function displayDepartment()
    {
        return view('admin.department');
    }
    function displayNotifications()
    {
        return view('admin.notification');
    }
}
