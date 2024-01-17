<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CompletedController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('/tasks')->name('tasks')->group(function () {
        Route::get('/', [TaskController::class, 'index']);
        Route::get('create', [TaskController::class, 'create'])->name('.create');
        Route::post('/', [TaskController::class, 'store'])->name('.store');
        Route::get('{taskId}/edit', [TaskController::class, 'edit'])->name('.edit');
        Route::put('{taskId}', [TaskController::class, 'update'])->name('.update');
        Route::patch('{taskId}/complete', [TaskController::class, 'complete'])->name('.complete');
        Route::delete('{taskId}', [TaskController::class, 'delete'])->name('.delete');
    });

    Route::prefix('/calendar')->name('calendar')->group(function () {
        Route::get('/', [CalendarController::class, 'index']);
    });

    Route::prefix('/completed')->name('completed')->group(function () {
        Route::get('/', [CompletedController::class, 'index']);
    });

    Route::prefix('/help')->name('help')->group(function () {
        Route::get('/', [HelpController::class, 'index']);
    });

    Route::prefix('/export')->name('export')->group(function () {
        Route::get('/', [ExportController::class, 'index']);
        Route::get('/download', [ExportController::class, 'export'])->name('.download');
    });
});

require __DIR__ . '/auth.php';
