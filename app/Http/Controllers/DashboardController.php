<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard');
    }

    public function profile()
    {
        return view('user.profile');
    }
}
