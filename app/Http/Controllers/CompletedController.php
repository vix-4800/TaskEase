<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompletedController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks->where('completed', true);

        return view('completed.index', compact('tasks'));
    }
}
