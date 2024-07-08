<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        return view('service-schedule');
    }

    public function display()
    {
        return view('display-schedule');
    }
}
