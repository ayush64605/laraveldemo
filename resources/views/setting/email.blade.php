<x-pannel-layout>
    <h1 class="text-2xl font-bold">General Settings</h1>
    <div class="grid grid-cols-5 gap-4">
        @include('setting.settingsidebar')
        <div class="p-4 mt-4 border-1 border-solid h-fit border-gray-200 col-span-4">
            <h1 class="text-2xl font-bold">Email Settings</h1>
            <p class="mt-4 text-gray-600">This is Email Setting's Description</p>
        </div>
    </div>
</x-pannel-layout>
