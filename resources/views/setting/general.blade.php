<x-pannel-layout>
    <h1 class="text-2xl font-bold">General Settings</h1>
    <div class="grid grid-cols-5 gap-4">
        @include('setting.settingsidebar')
        <div class="p-4 mt-4 border border-solid h-fit border-gray-200 col-span-4">

            <form action="{{ route('setting.general_save') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id">

                <h2 class="text-lg font-semibold text-gray-900">
                    Site Setting
                </h2>

                @if (session('error'))
                    <x-alert type="error" :message="session('error')" />
                @endif
                @if (session('success'))
                    <x-alert type="success" :message="session('success')" />
                @endif
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-900">Site Name
                        </label>
                        <input type="text" name="site_name" placeholder="Enter Site Name"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            value="{{ $setting->site_name }}">
                        @error('site_name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Time Zone
                        </label>
                        <select type="text" name="time_zone"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="UTC" {{ $setting->time_zone == 'UTC' ? 'selected' : '' }}>UTC</option>
                            <option value="IST" {{ $setting->time_zone == 'IST' ? 'selected' : '' }}>IST</option>
                        </select>
                        @error('timezone')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Date Format
                        </label>
                        <select type="text" name="date_format"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="Y-m-d" {{ $setting->date_format == 'Y-m-d' ? 'selected' : '' }}>Y-m-d
                            </option>
                            <option value="d-m-Y" {{ $setting->date_format == 'd-m-Y' ? 'selected' : '' }}>d-m-Y
                            </option>
                        </select>
                        @error('timezone')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Time Format
                        </label>
                        <select type="text" name="time_format"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="24 hours" {{ $setting->time_format == '24 hours' ? 'selected' : '' }}>24
                                hours</option>
                            <option value="12 hours" {{ $setting->time_format == '12 hours' ? 'selected' : '' }}>12
                                hours</option>
                        </select>
                        @error('timezone')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Default Language
                        </label>
                        <select type="text" name="language"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="English" {{ $setting->language == 'English' ? 'selected' : '' }}>English
                            </option>
                            <option value="Hindi" {{ $setting->language == 'Hindi' ? 'selected' : '' }}>Hindi</option>
                        </select>
                        @error('timezone')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Meta Title
                        </label>
                        <input type="text" name="meta_title" placeholder="Enter Meta Title"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            value="{{ $setting->meta_title }}">
                        @error('meta_title')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-900">Meta Description
                        </label>
                        <input type="text" name="meta_description" placeholder="Enter Meta Description"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            value="{{ $setting->meta_description }}">
                        @error('meta_description')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-900">Meta Keywords
                        </label>
                        <input type="text" name="meta_keywords" placeholder="Enter Meta Keywords"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            value="{{ $setting->meta_keywords }}">
                        @error('meta_keywords')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <!-- Site Logo -->
                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-900 mb-2">Site Logo</label>
                            <div class="flex items-center justify-center w-full">
                                <label for="logo"
                                    class="flex flex-col items-center justify-center w-full border-2 p-4 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center">
                                        <svg class="w-8 h-8 mb-4 text-gray-500" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="text-sm text-gray-500"><span class="font-semibold">Drag & drop</span>
                                        </p>
                                    </div>
                                    <input id="logo" name="site_logo" type="file" class="hidden"
                                        onchange="previewFile(this, 'logo-preview-container', 'logo-img', 'remove_logo')" />
                                </label>
                            </div>
                        </div>

                        <input type="hidden" name="remove_site_logo" id="remove_logo" value="0">

                        <div id="logo-preview-container"
                            class="{{ $setting->site_logo ? 'block' : 'hidden' }} relative border-2 p-4 border-gray-300 border-dashed rounded-lg bg-gray-50 mt-8 w-fit h-fit">
                            <button type="button"
                                onclick="removeFile('logo', 'logo-preview-container', 'logo-img', 'remove_logo')"
                                class="bg-red-500 text-white rounded-full p-1 hover:bg-red-600 shadow-sm"
                                style="position: absolute; top: 5px; left: 5px;">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                            <img id="logo-img" src="{{ asset('/storage/' . $setting->site_logo) }}" alt="Logo"
                                width="80">
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-900 mb-2">Favicon</label>
                            <div class="flex items-center justify-center w-full">
                                <label for="favicon"
                                    class="flex flex-col items-center justify-center w-full border-2 p-4 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center">
                                        <svg class="w-8 h-8 mb-4 text-gray-500" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="text-sm text-gray-500"><span class="font-semibold">Drag &
                                                drop</span></p>
                                    </div>
                                    <input id="favicon" name="favicon" type="file" class="hidden"
                                        onchange="previewFile(this, 'favicon-preview-container', 'favicon-img', 'remove_favicon')" />
                                </label>
                            </div>
                        </div>

                        <input type="hidden" name="remove_favicon" id="remove_favicon" value="0">

                        <div id="favicon-preview-container"
                            class="{{ $setting->favicon ? 'block' : 'hidden' }} relative border-2 p-4 border-gray-300 border-dashed rounded-lg bg-gray-50 mt-8 w-fit h-fit">
                            <button type="button"
                                onclick="removeFile('favicon', 'favicon-preview-container', 'favicon-img', 'remove_favicon')"
                                class="bg-red-500 text-white rounded-full p-1 hover:bg-red-600 shadow-sm"
                                style="position: absolute; top: 5px; left: 5px;">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                            <img id="favicon-img" src="{{ asset('/storage/' . $setting->favicon) }}" alt="Favicon"
                                width="80">
                        </div>
                    </div>
                </div>


                <div class="mt-8 flex justify-end gap-4">
                    <x-button type="submit" color="bg-indigo-600" text="Save" icon="save" />
                </div>

            </form>
        </div>
    </div>
    <script>
        function previewFile(input, containerId, imgId, hiddenId) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(imgId).src = e.target.result;
                    document.getElementById(containerId).classList.remove('hidden');
                    document.getElementById(hiddenId).value = "0";
                }
                reader.readAsDataURL(file);
            }
        }

        function removeFile(inputId, containerId, imgId, hiddenId) {
            document.getElementById(inputId).value = "";
            document.getElementById(containerId).classList.add('hidden');
            document.getElementById(imgId).src = "";
            document.getElementById(hiddenId).value = "1";
        }
    </script>
</x-pannel-layout>
