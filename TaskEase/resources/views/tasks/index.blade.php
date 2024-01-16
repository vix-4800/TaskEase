<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tasks
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-6 text-gray-900 dark:text-gray-100">
                    <div class="card-body">
                        @if($tasks->isEmpty())
                        <p class="mb-5">
                            No tasks found.
                        </p>

                        @else
                        <ul>
                            @foreach($tasks as $task)
                            <li>
                                <div class="flex items-center">
                                    <strong class="text-2xl">
                                        {{ $task->title }}
                                    </strong>

                                    @if($task->completed)
                                    <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 ml-4">
                                        Completed
                                    </span>
                                    @else
                                    <span style="height: min-content" class="bg-yellow-100 text-yellow-700 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-800 dark:text-yellow-300 ml-4">
                                        Pending
                                    </span>
                                    @endif

                                    @if ($task->priority)
                                    @php
                                    switch ($task->priority) {
                                    case 1:
                                    $textColor = 'text-green-900';
                                    $bgColor = 'bg-green-500';
                                    break;
                                    case 2:
                                    $textColor = 'text-green-200';
                                    $bgColor = 'bg-green-900';
                                    break;
                                    case 3:
                                    $textColor = 'text-yellow-900';
                                    $bgColor = 'bg-yellow-400';
                                    break;
                                    case 4:
                                    $textColor = 'text-red-100';
                                    $bgColor = 'bg-orange-500';
                                    break;
                                    case 5:
                                    $textColor = 'text-red-200';
                                    $bgColor = 'bg-red-800';
                                    break;
                                    }
                                    @endphp

                                    <span style="height: min-content" class="text-xs {{$textColor}} {{$bgColor}} font-medium px-2.5 py-0.5 rounded ">
                                        Task priority: {{$task->priority}}
                                    </span>
                                    @endif
                                </div>

                                @if($task->description)
                                <p class="mb-2 text-base">
                                    {{ $task->description }}
                                </p>
                                @endif

                                <span class="mt-2">
                                    Due date: {{ $task->due_date ?? 'Not specified' }}
                                </span>

                                <div class="mt-3 flex">
                                    <form action="{{ route('tasks.complete', ['taskId' => $task->id]) }}" method="post">
                                        @csrf
                                        @method('patch')

                                        <button type="submit" class="mr-3 inline-flex items-center px-4 py-2 bg-green-800 dark:bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-green-700 dark:hover:bg-green-700 focus:bg-green-700 dark:focus:bg-green active:bg-green-900 dark:active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                            Complete task
                                        </button>
                                    </form>

                                    <a href="{{ route('tasks.edit', ['taskId' => $task->id]) }}" class='mr-3 inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150'>
                                        Edit
                                    </a>

                                    <form action="{{ route('tasks.delete', ['taskId' => $task->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class='inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </li>
                            <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
                            @endforeach
                        </ul>
                        @endif

                        <a href="{{route('tasks.create')}}" class='inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'>
                            New task
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
