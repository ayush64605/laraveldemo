<x-pannel-layout>
    <h1 class="text-2xl font-bold mb-6 p-4">General Settings</h1>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
        <div class="col-span-1">
            @include('setting.settingsidebar')
        </div>

        <div class="col-span-1 lg:col-span-4">
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
                <form action="{{ route('setting.general_save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id">

                    @if (session('error'))
                        <x-alert type="error" :message="session('error')" class="mb-4" />
                    @endif
                    @if (session('success'))
                        <x-alert type="success" :message="session('success')" class="mb-4" />
                    @endif

                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Site Settings</h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-900">Site Name</label>
                            <input type="text" name="site_name" placeholder="Enter Site Name"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                value="{{ $setting->site_name }}">
                            @error('site_name')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-900">Time Zone</label>
                            <select name="time_zone"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="UTC" {{ $setting->time_zone == 'UTC' ? 'selected' : '' }}>UTC</option>
                                <option value="IST" {{ $setting->time_zone == 'IST' ? 'selected' : '' }}>IST</option>
                            </select>
                            @error('time_zone')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-900">Date Format</label>
                            <select name="date_format"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="Y-m-d" {{ $setting->date_format == 'Y-m-d' ? 'selected' : '' }}>Y-m-d
                                </option>
                                <option value="d-m-Y" {{ $setting->date_format == 'd-m-Y' ? 'selected' : '' }}>d-m-Y
                                </option>
                            </select>
                            @error('date_format')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-900">Time Format</label>
                            <select name="time_format"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="24 hours" {{ $setting->time_format == '24 hours' ? 'selected' : '' }}>24
                                    hours</option>
                                <option value="12 hours" {{ $setting->time_format == '12 hours' ? 'selected' : '' }}>12
                                    hours</option>
                            </select>
                            @error('time_format')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-900">Default Language</label>
                            <select name="language"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="English" {{ $setting->language == 'English' ? 'selected' : '' }}>English
                                </option>
                                <option value="Hindi" {{ $setting->language == 'Hindi' ? 'selected' : '' }}>Hindi
                                </option>
                            </select>
                            @error('language')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-900">Meta Title</label>
                            <input type="text" name="meta_title" placeholder="Enter Meta Title"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                value="{{ $setting->meta_title }}">
                            @error('meta_title')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-900">Meta Description</label>
                            <input type="text" name="meta_description" placeholder="Enter Meta Description"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                value="{{ $setting->meta_description }}">
                            @error('meta_description')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-900">Meta Keywords</label>
                            <input type="text" name="meta_keywords" placeholder="Enter Meta Keywords"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                value="{{ $setting->meta_keywords }}">
                            @error('meta_keywords')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-900 mb-2">Site Logo</label>
                            <div class="flex items-center gap-4">
                                <div id="logo-upload-box"
                                    class="{{ $setting->site_logo ? 'hidden' : 'flex' }} flex-1 justify-center items-center border-2 border-dashed rounded-lg p-4 cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                                    <label for="logo"
                                        class="flex flex-col items-center justify-center w-full h-full cursor-pointer">
                                        <svg class="w-8 h-8 text-gray-500 mb-2" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M4 12l8-8 8 8" />
                                        </svg>
                                        <span class="text-gray-500 text-sm font-semibold">Upload Logo</span>
                                    </label>
                                    <input type="file" id="logo" name="site_logo" class="hidden"
                                        onchange="previewFile(this, 'logo-preview-container', 'logo-img', 'remove_logo', 'logo-upload-box')">
                                </div>

                                <div id="logo-preview-container"
                                    class="{{ $setting->site_logo ? 'block' : 'hidden' }} relative w-32 h-32 border-2 border-dashed rounded-lg p-2 bg-gray-50">
                                    <button type="button"
                                        onclick="removeFile('logo', 'logo-preview-container', 'logo-img', 'remove_logo', 'logo-upload-box')"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 shadow-sm z-10">
                                        &times;
                                    </button>
                                    <img id="logo-img" src="{{ asset('/storage/' . $setting->site_logo) }}"
                                        class="w-full h-full object-contain rounded">
                                </div>
                                <input type="hidden" name="remove_site_logo" id="remove_logo" value="0">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-900 mb-2">Favicon</label>
                            <div class="flex items-center gap-4">
                                <div id="favicon-upload-box"
                                    class="{{ $setting->favicon ? 'hidden' : 'flex' }} flex-1 justify-center items-center border-2 border-dashed rounded-lg p-4 cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                                    <label for="favicon"
                                        class="flex flex-col items-center justify-center w-full h-full cursor-pointer">
                                        <svg class="w-8 h-8 text-gray-500 mb-2" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M4 12l8-8 8 8" />
                                        </svg>
                                        <span class="text-gray-500 text-sm font-semibold">Upload Favicon</span>
                                    </label>
                                    <input type="file" id="favicon" name="favicon" class="hidden"
                                        onchange="previewFile(this, 'favicon-preview-container', 'favicon-img', 'remove_favicon', 'favicon-upload-box')">
                                </div>

                                <div id="favicon-preview-container"
                                    class="{{ $setting->favicon ? 'block' : 'hidden' }} relative w-32 h-32 border-2 border-dashed rounded-lg p-2 bg-gray-50">
                                    <button type="button"
                                        onclick="removeFile('favicon', 'favicon-preview-container', 'favicon-img', 'remove_favicon', 'favicon-upload-box')"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 shadow-sm z-10">
                                        &times;
                                    </button>
                                    <img id="favicon-img" src="{{ asset('/storage/' . $setting->favicon) }}"
                                        class="w-full h-full object-contain rounded">
                                </div>
                                <input type="hidden" name="remove_favicon" id="remove_favicon" value="0">
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-button type="submit" color="bg-indigo-600" text="Save" icon="save" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewFile(input, previewContainerId, imgId, hiddenInputId, uploadSectionId) {
            const previewContainer = document.getElementById(previewContainerId);
            const uploadSection = document.getElementById(uploadSectionId);
            const img = document.getElementById(imgId);
            const hiddenRemoveInput = document.getElementById(hiddenInputId);

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    uploadSection.classList.add('hidden');
                    hiddenRemoveInput.value = "0";
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeFile(inputId, previewContainerId, imgId, hiddenInputId, uploadSectionId) {
            const input = document.getElementById(inputId);
            const previewContainer = document.getElementById(previewContainerId);
            const uploadSection = document.getElementById(uploadSectionId);
            const hiddenRemoveInput = document.getElementById(hiddenInputId);

            input.value = "";
            previewContainer.classList.add('hidden');
            uploadSection.classList.remove('hidden');
            hiddenRemoveInput.value = "1";
        }
    </script>
</x-pannel-layout>
