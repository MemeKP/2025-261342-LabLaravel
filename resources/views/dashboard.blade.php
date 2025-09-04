<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-center text-black dark:text-gray-100 text-2xl font-bold">
                    {{ __("Hello, admin!") }}
                </div>
                <div class="text-center font-bold text-2xl text-sky-500">
                     Birthdate is {{ Auth::user()->birthdate ?? 'Not set' }}
                </div>
                <div>
                    @if (Auth::user()->profile_photo)
                        <div class="p-6 flex justify-center">
                            <img src="{{ route('user.photo', ['filename' => Auth::user()->profile_photo]) }}" alt="Profile Photo"
                                class="w-32 h-32 object-cover rounded-full" />
                        </div>
                    @endif
                </div>
                <div class="text-center text-black dark:text-gray-100 text-l font-bold fw-bold" >
                    {{ __("Ei Ei") }}
                </div>
                <div class="p-3 text-center text-black dark:text-gray-100 text-base font-bold fw-bold">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    
</x-app-layout>
