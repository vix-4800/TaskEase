<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Update task "{{$task->title}}"
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('tasks.update', ['taskId' => $task->id]) }}" method="post" class="space-y-6">
                        @csrf
                        @method('put')

                        <div style="margin-top: 0 !important">
                            <x-input-label for="title" :value="__('New title')" />
                            <x-text-input id="title" name="title" :placeholder="old('name', $task->title)" type="text" class="mt-1 block w-full" autofocus autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('New description')" />
                            <x-text-input id="description" name="description" :placeholder="old('name', $task->description ?? 'Not definied')" type="text" class="mt-1 block w-full" autocomplete="description" />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="priority" :value="__('Priority')" />
                            <x-text-input id="priority" name="priority" :placeholder="old('name', $task->priority ?? 'Not definied')" type="number" pattern="[1-5]" class="mt-1 block w-full" autocomplete="priority" />
                            <x-input-error class="mt-2" :messages="$errors->get('priority')" />
                        </div>

                        <div>
                            <x-input-label for="due_date" :value="__('New due date')" />
                            <x-text-input id="due_date" name="due_date" type="date" class="mt-1 block w-full" autocomplete="due_date" />
                            <x-input-error class="mt-2" :messages="$errors->get('due_date')" />
                        </div>

                        <div class="flex items-center">
                            <x-primary-button>
                                Update
                            </x-primary-button>

                            <a href="{{route('tasks')}}" class='ml-3 inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150'>
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
