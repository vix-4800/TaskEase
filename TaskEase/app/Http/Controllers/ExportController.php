<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;

class ExportController extends Controller
{
    public function index()
    {
        return view('export.index');
    }

    public function export(Request $request)
    {
        $tasks = auth()->user()->tasks;

        $csv = Writer::createFromString('');

        $csv->insertOne(['Title', 'Description', 'Due Date', 'Status', 'Priority', 'Created At']);

        foreach ($tasks as $task) {
            $csv->insertOne([
                $task->title,
                $task->description,
                $task->due_date,
                $task->completed ? 'completed' : 'pending',
                $task->priority,
                $task->created_at->format('Y:m:d H:i'),
            ]);
        }

        $csvContent = $csv->toString();

        $filename = 'tasks_export_' . now()->format('Ymd_Hi') . '.csv';
        Storage::put('csv\\' . $filename, $csvContent);

        return response()->download(storage_path('app\csv\\' . $filename), $filename)->deleteFileAfterSend(true);
    }
}
