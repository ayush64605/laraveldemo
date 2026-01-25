<x-pannel-layout>
    <h1 class="text-2xl font-bold mb-4 p-4">Re-Captcha Settings</h1>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

        @include('setting.settingsidebar')

        <div class="p-6 border border-gray-200 rounded-md bg-white shadow-sm col-span-4">

            <form action="{{ route('setting.captcha_save') }}" method="POST" enctype="multipart/form-data"
                x-data="{ is_on: {{ $setting->status == 'on' ? 'true' : 'false' }} }">
                @csrf

                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Bot Protection</h2>
                        <p class="text-gray-500 text-sm">Enable advanced bot prevention to protect your site from spam
                            and malicious activity.</p>
                    </div>

                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="status" value="on" x-model="is_on" class="sr-only peer">
                        <div
                            class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-green-600 after:content-[''] after:absolute after:left-0.5 after:bg-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full">
                        </div>
                    </label>
                </div>

                @if (session('error'))
                    <x-alert type="error" :message="session('error')" class="mb-4" />
                @endif
                @if (session('success'))
                    <x-alert type="success" :message="session('success')" class="mb-4" />
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6" x-show="is_on">
                    <div>
                        <label class="block text-sm font-medium text-gray-900 mb-1">Site Key <span
                                class="text-red-600">*</span></label>
                        <input type="text" name="site_key" placeholder="Enter Site Key"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            value="{{ old('site_key', $setting->site_key) }}">
                        @error('site_key')
                            <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900 mb-1">Site Secret <span
                                class="text-red-600">*</span></label>
                        <input type="text" name="site_secret" placeholder="Enter Site Secret"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            value="{{ old('site_secret', $setting->site_secret) }}">
                        @error('site_secret')
                            <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded-md mb-6">
                    <h3 class="text-yellow-700 font-semibold mb-1">Important Configuration Notice</h3>
                    <p class="text-yellow-600 text-sm">
                        Make sure to select reCAPTCHA v3 when setting up your credentials. Incorrect settings may cause
                        authentication issues.
                    </p>
                </div>

                <div class="flex justify-end">
                    <x-button type="submit" color="bg-indigo-600" text="Save" icon="save" />
                </div>

            </form>
        </div>
    </div>

</x-pannel-layout>
