<x-pannel-layout>
    <style>
        .after\:left-0\.5:after {
            top: 16px
        }
    </style>
    <h1 class="text-2xl font-bold">Re-Captcha Settings</h1>
    <div class="grid grid-cols-5 gap-4">
        @include('setting.settingsidebar')
        <div class="p-4 mt-4 border border-solid h-fit border-gray-200 col-span-4">

            <form action="{{ route('setting.captcha_save') }}" method="POST" enctype="multipart/form-data"
                x-data="{ is_on: {{ $setting->status == 'on' ? 'true' : 'false' }} }">
                @csrf

                <div class="flex justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Bot Protection</h2>
                        <p class="text-gray-500">Implement advanced bot prevention...</p>
                    </div>

                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="status" value="on" x-model="is_on"
                            {{ $setting->status == 'on' ? 'checked' : '' }} class="sr-only peer">
                        <div
                            class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-green-600 after:content-[''] after:absolute after:left-0.5 after:bg-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full">
                        </div>
                    </label>
                </div>

                @if (session('error'))
                    <x-alert type="error" :message="session('error')" />
                @endif
                @if (session('success'))
                    <x-alert type="success" :message="session('success')" />
                @endif
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4" x-show="is_on">
                    <div>
                        <label class="block text-sm font-medium text-gray-900">Site Key<span
                                class="text-red-600">*</span></label>
                        <input type="text" name="site_key" placeholder="Enter Site Key"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            value="{{ old('site_key', $setting->site_key) }}">
                        @error('site_key')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Site Secret<span
                                class="text-red-600">*</span></label>
                        <input type="text" name="site_secret" placeholder="Enter Site Secret"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            value="{{ old('site_secret', $setting->site_secret) }}">
                        @error('site_secret')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 border border-yellow-500 rounded-md p-4 bg-yellow-50">
                    <h2 class="text-md font-semibold text-yellow-700">
                        Important Configuration Notice
                    </h2>
                    <p class="text-yellow-600 text-sm">Make sure to select reCAPTCHA 13 when setting up your
                        credentials. Using
                        Incorrect settings may cause authentication system interruptions.</p>
                </div>

                <div class="mt-8 flex justify-end gap-4">
                    <x-button type="submit" color="bg-indigo-600" text="Save" icon="save" />
                </div>

            </form>
        </div>
    </div>
</x-pannel-layout>
