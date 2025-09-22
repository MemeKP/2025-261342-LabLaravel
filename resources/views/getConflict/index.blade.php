<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Conflicting Emotions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Summary</h3>

                    <table class="min-w-full border border-gray-300 dark:border-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 border">ID</th>
                                <th class="px-4 py-2 border">Date</th>
                                <th class="px-4 py-2 border">Content</th>
                                <th class="px-4 py-2 border">Emotion</th>
                                <th class="px-4 py-2 border">Intensity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($conflictingEntries as $entry)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $entry->id }}</td>
                                    <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($entry->date)->format('M d, Y') }}</td>
                                    <td class="px-4 py-2 border">{{ $entry->content }}</td>
                                    <td class="px-4 py-2 border text-blue-600">{{ $entry->emotion }}</td>
                                    <td class="px-4 py-2 border text-center">
                                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-600">
                                            {{ $entry->intensity }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-2 text-center text-gray-500">
                                        No conflicting entries found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
