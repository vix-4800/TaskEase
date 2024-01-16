<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks;

        return view('calendar.index', compact('tasks'));
    }
}
