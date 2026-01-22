<x-pannel-layout>
    <h1 class="text-2xl font-bold">Theme Settings</h1>
    <div class="grid grid-cols-5 gap-4">
        @include('setting.settingsidebar')
        <div class="p-4 mt-4 border border-solid h-fit border-gray-200 col-span-4">

            <form action="{{ route('setting.theme_save') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id">

                <h2 class="text-lg font-semibold text-gray-900">
                    Theme Setting
                </h2>

                @if (session('error'))
                    <x-alert type="error" :message="session('error')" />
                @endif
                @if (session('success'))
                    <x-alert type="success" :message="session('success')" />
                @endif
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-900">Select Color<span
                                class="text-red-600">*</span>
                        </label>
                        <input type="color" name="theme_color"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" value="{{ $setting->theme_color }}">
                        @error('theme_color')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-4">
                    <x-button type="submit" color="bg-indigo-600" text="Save Project" icon="save" />
                </div>

            </form>
        </div>
    </div>
</x-pannel-layout>
