@props([
    'id' => 'modal',
    'title' => 'Modal Title',
    'description' => '',
])

<div id="{{ $id }}" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 text-left">

        <h3 class="text-lg font-semibold text-gray-900">
            {{ $title ?? '' }}
        </h3>

        <p class="mt-2 text-sm text-gray-600">
            {!! $description ?? '' !!}
        </p>

        {{ $slot }}
    </div>
</div>
