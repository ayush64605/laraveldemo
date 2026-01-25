<x-pannel-layout>
    <h1 class="text-2xl font-bold mb-4 p-4">Theme Settings</h1>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

        @include('setting.settingsidebar')

        <div class="p-6 border border-gray-200 rounded-md bg-white shadow-sm col-span-4">

            <form action="{{ route('setting.theme_save') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id">

                <h2 class="text-lg font-semibold text-gray-900 mb-4">Theme Settings</h2>

                @if (session('error'))
                    <x-alert type="error" :message="session('error')" class="mb-4" />
                @endif
                @if (session('success'))
                    <x-alert type="success" :message="session('success')" class="mb-4" />
                @endif

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Theme Color</label>
                        <div
                            class="flex items-center gap-3 p-2 border border-gray-200 rounded-xl bg-white shadow-sm hover:border-indigo-400 transition-all">

                            <input type="color" name="theme_color"
                                class="h-10 w-10 cursor-pointer appearance-none border-none rounded-full"
                                value="{{ $setting->theme_color }}">

                            <span class="text-sm font-mono text-gray-500 uppercase tracking-wider">
                                {{ $setting->theme_color }}
                            </span>
                        </div>
                        @error('theme_color')
                            <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="mt-8 flex justify-end gap-4">
                    <x-button type="submit" color="bg-indigo-600" text="Save" icon="save" />
                </div>
            </form>
        </div>
    </div>

    <style>
        @media (max-width: 1024px) {
            .grid-cols-5 {
                grid-template-columns: 1fr !important;
            }

            .col-span-4 {
                grid-column: span 1 / span 1;
            }
        }
    </style>
</x-pannel-layout>
