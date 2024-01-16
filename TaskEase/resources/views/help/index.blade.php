<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Help Center
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-6 text-gray-900 dark:text-gray-100">
                    <div class="card-body">
                        <p>
                            Welcome to TaskEase Help Center! If you're experiencing any issues or have questions about our application, we're here to assist you.
                            <br>
                            Below are some common topics that might help you find the information you need.
                        </p>

                        <h2 class="my-3 text-2xl font-extrabold dark:text-white">
                            Frequently Asked Questions (FAQs)
                        </h2>
                        <x-faq-question>
                            Q: How do I create a new task?
                        </x-faq-question>
                        <x-faq-answer>
                            A: To create a new task, navigate to the "Tasks" tab and click on the "New task" button. Fill in the required details and click "Create task".
                        </x-faq-answer>

                        <x-faq-question>
                            Q: How can I edit an existing task?
                        </x-faq-question>
                        <x-faq-answer>
                            A: To edit a task, go to the "Tasks" tab, find the task you want to modify, and click the "Edit" button. Update the necessary fields, then click "Update" to save your changes.
                        </x-faq-answer>

                        <x-faq-question>
                            Q: Where do completed tasks go?
                        </x-faq-question>
                        <x-faq-answer>
                            A: Completed tasks are moved to the "Completed" tab. You can access this tab to view all your completed tasks and keep track of your accomplishments.
                        </x-faq-answer>

                        <h2 class="my-3 text-2xl font-extrabold dark:text-white">
                            Contact Us
                        </h2>
                        <p>
                            If you can't find the information you need or are facing technical issues,
                            please don't hesitate to reach out to us.
                            You can contact our support team via email at <a class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline" href="mailto:support@taskease.com">support@taskease.com</a>.
                            We'll get back to you as soon as possible to assist with your concerns.
                        </p>

                        <p class="mt-2">
                            Thank you for using TaskEase!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
