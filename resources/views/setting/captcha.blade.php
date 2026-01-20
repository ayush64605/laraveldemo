<x-pannel-layout>
    <h1 class="text-2xl font-bold">General Settings</h1>
    <div class="grid grid-cols-5 gap-4">
        @include('setting.settingsidebar')
        <div class="p-4 mt-4 border border-solid h-fit border-gray-200 col-span-4">
            <h1 class="text-2xl font-bold">Re-Captcha Settings</h1>
            <p class="mt-4 text-gray-600">This is Re-Captcha Setting's Description</p>
        </div>
    </div>
</x-pannel-layout>
