<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                {{-- Post the data to store route --}}
                <form action="{{ route('notes.store') }}" method="post">
                    {{-- TIP: All forms using POST, PUT, PATCH and DELETE verbs must use @csrf directive --}}
                    @csrf

                    <x-text-input class="w-full" autocomplete="off" type="text" name="title" placeholder="Title">
                    </x-text-input>
                    <x-textarea class="w-full mt-6" name="text" placeholder="Start typing here..." cols="30"
                        rows="10"></x-textarea>
                    <x-primary-button class="mt-6">Save Note</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
