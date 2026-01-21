@props([
    'id' => 'modal',        
    'title' => 'Modal Title', 
    'action' => '#',
])

<div id="{{ $id }}" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 text-left">
        <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf

            <h2 class="text-lg font-semibold text-gray-900">
                {{ $title }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-4">
                {{ $slot }}
            </div>

            <div class="mt-8 flex justify-end gap-4">
                <x-button type="button" color="bg-red-600" text="Cancel" icon="cancel"
                    onclick="document.getElementById('{{ $id }}').classList.add('hidden')" />
                <x-button type="submit" color="bg-indigo-600" text="Save" icon="save" />
            </div>
        </form>
    </div>
</div>
