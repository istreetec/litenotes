<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                {{-- NOTE: HTML forms can use PUT/PATCH verbs --}}
                <form action="{{ route('notes.update', $note) }}" method="post">
                    {{-- HINT: Spoof the HTML `post` method above using @method directive with `put` --}}
                    @method('put')
                    @csrf

                    {{-- - prepend with `:` to make it available in the component as prop. 
                            - value should now be the existing note value if old value is blank.
                        --}}
                    <x-text-input field="title" class="w-full" autocomplete="off" type="text" name="title"
                        placeholder="Title" :value="@old('title', $note->title)">
                    </x-text-input>

                    <x-textarea field="text" class="w-full mt-6" name="text" placeholder="Start typing here..."
                        cols="30" rows="10" :value="@old('text', $note->text)"></x-textarea>

                    <x-primary-button class="mt-6">Save Note</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
