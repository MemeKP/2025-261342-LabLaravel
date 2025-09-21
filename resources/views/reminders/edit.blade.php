<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Reminder') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Form to edit reminder -->
                    <form method="POST" action="{{ route('reminder.update', $reminder->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title', $reminder->title) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100 @error('title') border-red-500 @enderror" 
                                   required>
                            @error('title')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Content</label>
                            <textarea id="content" 
                                      name="content" 
                                      rows="5" 
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100 @error('content') border-red-500 @enderror">{{ old('content', $reminder->content) }}</textarea>
                            @error('content')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remind At -->
                        <div class="mb-4">
                            <label for="remind_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Remind At <span class="text-red-500">*</span>
                            </label>
                            <input type="datetime-local" 
                                   id="remind_at" 
                                   name="remind_at" 
                                   value="{{ old('remind_at', $reminder->remind_at->format('Y-m-d\TH:i')) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100 @error('remind_at') border-red-500 @enderror" 
                                   required>
                            @error('remind_at')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Status
                            </label>
                            <select name="status"
                                    id="status"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('status') border-red-500 @enderror">
                                <option value="New" {{ old('status', $reminder->status) == 'New' ? 'selected' : '' }}>New</option>
                                <option value="In Progress" {{ old('status', $reminder->status) == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Completed" {{ old('status', $reminder->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            @error('status')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tags -->
                        <div class="mb-4">
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Select Tags</label>
                                <div class="flex flex-wrap">
                                    @foreach ($tags as $tag)
                                        <div class="mr-4 mb-2">
                                            <input type="checkbox" 
                                                   id="tag_{{ $tag->id }}" 
                                                   name="tags[]"
                                                   value="{{ $tag->id }}"
                                                   {{ in_array($tag->id, old('tags', $reminder->tags->pluck('id')->toArray())) ? 'checked' : '' }}
                                                   class="h-5 w-5 text-indigo-600 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-indigo-600">
                                            <label for="tag_{{ $tag->id }}"
                                                   class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ $tag->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('tags')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('reminder.index') }}"
                               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">
                                {{ __('Cancel') }}
                            </a>
                            <button type="submit" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                                {{ __('Update Reminder') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>