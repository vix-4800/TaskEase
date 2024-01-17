<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks->where('completed', false);

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:25',
            'description' => 'nullable',
            'due_date' => 'nullable|date',
            'priority' => 'nullable|numeric|min:1|max:5',
        ]);

        Task::create([
            'user_id' => auth()->id(),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'due_date' => $request->input('due_date'),
            'priority' => $request->input('priority'),
        ]);

        return redirect()->route('tasks')->with('success', 'New task added!');
    }

    public function edit(int $taskId)
    {
        $task = Task::find($taskId);

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, int $taskId)
    {
        $request->validate([
            'title' => 'nullable|max:25',
            'description' => 'nullable',
            'due_date' => 'nullable|date',
            'priority' => 'nullable|numeric|min:1|max:5',
        ]);

        $task = Task::find($taskId);

        if ($request->input('title')) {
            $task->title = $request->input('title');
        }

        if ($request->input('description')) {
            $task->description = $request->input('description');
        }

        if ($request->input('due_date')) {
            $task->due_date = $request->input('due_date');
        }

        if ($request->input('priority')) {
            $task->priority = $request->input('priority');
        }

        $task->save();

        return back()->with('success', 'Task updated!');
    }

    public function delete(int $taskId)
    {
        Task::find($taskId)->delete();

        return back()->with('success', 'Task deleted successfully.');
    }

    public function complete(int $taskId)
    {
        $task = Task::find($taskId);
        $task->completed = true;
        $task->completed_at = now()->format('Y-m-d H:i');
        $task->save();

        return back()->with('success', 'Task completed.');
    }
}
