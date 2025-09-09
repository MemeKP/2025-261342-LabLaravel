<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Social Media Link') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Form to create a new diary entry -->
                    <form method="POST" action="{{ route('link.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="platform" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Platform Name</label>
                            <input type="text" id="platform" name="platform" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100" value="{{ old('platform') }}" required>
                            @error('platform')
                                <div class="text-red-500 text-sm">{{ $message }}</div> <!-- Displaying the error message -->
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">URL</label>
                            <input type="url" id="url" name="url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100" required>{{ old('url') }}</input>
                            @error('url')
                                <div class="text-red-500 text-sm">{{ $message }}</div> <!-- Displaying the error message -->
                            @enderror
                        </div>

                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">{{ __('Save Link') }}</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- 
    <center>
        <!-- Back to Previous Page Button -->
        <!-- <x-secondary-button onclick="disableFormSubmissionAndGoBack()" >
            {{ __('Back to Previous') }}
        </x-secondary-button> -->
    <!-- </center> -->
    
    

    <script>
        function disableFormSubmissionAndGoBack() {
            window.onbeforeunload = null;  // Disable any beforeunload alert.
            window.history.back();  // Navigate back to the previous page.
        }
    </script>
</x-app-layout>