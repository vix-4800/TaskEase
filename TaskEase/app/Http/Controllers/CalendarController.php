<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        abort(503);

        $tasks = auth()->user()->tasks->where('due_date',);

        return view('calendar.index', compact('tasks'));
    }
}
