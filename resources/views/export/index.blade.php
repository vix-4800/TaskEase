<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Export
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-6 text-gray-900 dark:text-gray-100">
                    <div class="card-body">
                        <p class="mb-3">
                            This feature allows you to effortlessly download your tasks in CSV format, making it easy to manage and share your task data.
                        </p>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                            CSV Format:
                        </h2>

                        <ul class="mb-4 max-w-md space-y-2 text-gray-500 list-disc list-inside dark:text-gray-400">
                            <li class="ml-4">
                                Title
                            </li>
                            <li class="ml-4">
                                Description
                            </li>
                            <li class="ml-4">
                                Due Date
                            </li>
                            <li class="ml-4">
                                Status
                            </li>
                            <li class="ml-4">
                                Priority
                            </li>
                            <li class="ml-4">
                                Created At
                            </li>
                        </ul>

                        <a href="{{route('export.download')}}" class='inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150'>
                            Download
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
