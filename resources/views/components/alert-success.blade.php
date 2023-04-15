{{-- Check if we have any data with session success --}}
@if (session('success'))
    <div style="background-color: #23c97e; border-color: #D1E7DD" class="mb-4 px-4 py-2 bg-green border border-green-200 text-green-200 rounded-md">
        {{ $slot }}
    </div>
@endif
