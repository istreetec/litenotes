<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{-- Check the route name --}}
            {{-- NOTE: `__` double underscore is used for language translation. It's optional --}}
            {{ request()->routeIs('notes.index') ? __('Notes') : __('Trash') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            @if (request()->routeIs('notes.index'))
                <a href="{{ route('notes.create') }}" class="btn-link btn-lg mb-2">
                    + New Note
                </a>
            @endif

            {{-- use @forelse if there are no notes --}}
            @forelse ($notes as $note)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl">
                        {{-- Link to a note details --}}
                        <a href="{{ route('notes.show', $note) }}"> {{ $note->title }}</a>
                    </h2>
                    <p class="mt-2">
                        {{-- Display the text as excerpt --}}
                        {{ Str::limit($note->text, 200) }}
                    </p>
                    <span class="block mt-4 text-sm opacity-70">
                        {{ $note->updated_at->diffForHumans() }}
                    </span>
                </div>
            @empty
                @if (request()->routeIs('notes.index'))
                    <p>You have no notes yet.</p>
                @else
                    <p>No items in Trash</p>
                @endif
            @endforelse

            {{-- Display pagination --}}
            {{ $notes->links() }}
        </div>
    </div>
</x-app-layout>
