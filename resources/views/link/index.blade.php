<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Social Media Links') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4 flex justify-center">
                        <a href="{{ route('link.create') }}">
                            <button type="button"
                                class=" inline-flex items-center px-4 py-2 text-black bg-gradient-to-r from-sky-400 to-lime-500 font-semibold rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                                {{ __('Add New Link') }}
                            </button>
                        </a>
                    </div>
                    @if($linkEntries->count() > 0)
                        <!-- Table Header -->
                        <div class="mb-4">
                            <div class="grid grid-cols-3 gap-4 p-4 bg-gradient-to-r from-sky-100 to-lime-100 dark:bg-gray-700 rounded-t-lg font-semibold text-gray-700 dark:text-gray-300 border-b">
                                <div>PLATFORM</div>
                                <div>URL</div>
                                <div class="text-center">ACTIONS</div>
                            </div>
                        </div>
                    @endif
                    <!-- Social Links List -->
                    @foreach ($linkEntries as $entry)
                        <div class="mb-6 p-4 grid grid-row border-b-2 border-gray-200">
                             <!-- Platform Name -->
                                <div class="flex flex-row items-center justify-between items-center">
                                    <span class="font-medium text-gray-900 dark:text-gray-100">
                                        {{ $entry->platform }}
                                    </span>
                                
                        
                             <!-- URL -->
                              <div class="flex items-center">
                                    <a href="{{ $entry->url }}" target="_blank" 
                                       class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 hover:underline truncate">
                                        {{ $entry->url }}
                                    </a>
                                </div>

                            <div class="flex items-center justify-center space-x-2">{{ $entry->content }}</div>
                            <div class="mt-4 flex justify-end">
                                <x-primary-button style=" margin-right: 10px;"
                                    onclick="window.location.href='{{ route('link.edit', $entry) }}'">
                                    {{ __('Edit') }}
                                </x-primary-button>

                                <form method="POST" action="{{ route('link.destroy', $entry) }}"
                                    id="delete-form-{{ $entry->id }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button>
                                        {{ __('Delete') }}
                                    </x-danger-button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('status'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('status') }}',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                });
            @endif
        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
</x-app-layout>