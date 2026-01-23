<x-pannel-layout>
    <style>
        .after\:left-0\.5:after {
            top: 16px
        }
    </style>
    <h1 class="text-2xl font-bold">Annoucement</h1>
    <div class="grid grid-cols-5 gap-4">
        @include('setting.settingsidebar')
        <div class="p-4 mt-4 border border-solid h-fit border-gray-200 col-span-4">

            <form action="{{ route('setting.annoucement_save') }}" method="POST" enctype="multipart/form-data"
                x-data="{
                    is_on: {{ $setting->status == 'on' ? 'true' : 'false' }},
                    bg_color: '{{ old('bg_color', $setting->bg_color ?? '#edb1d7') }}',
                    msg_color: '{{ old('msg_color', $setting->msg_color ?? '#8fa5ff') }}',
                    txt_color: '{{ old('txt_color', $setting->txt_color ?? '#256b86') }}',
                    msg: '{{ old('msg', $setting->msg ?? 'hello') }}',
                    link_text: '{{ old('link_text', $setting->link_text ?? 'Visit me') }}'
                }">
                @csrf

                <div class="flex justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Is Enable</h2>
                        <p class="text-gray-500">Enable this option to display an announcement on the dashboard</p>
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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4" x-show="is_on">
                    <div>
                        <label class="block text-sm font-medium text-gray-900">Link<span
                                class="text-red-600">*</span></label>
                        <input type="text" name="link" placeholder="Enter Link"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            value="{{ old('link', $setting->link) }}">
                        @error('link')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Link Text<span
                                class="text-red-600">*</span></label>
                        <input type="text" name="link_text" x-model="link_text" placeholder="Enter Link Text"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @error('link_text')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-900">Message<span
                                class="text-red-600">*</span></label>
                        <textarea name="msg" x-model="msg" placeholder="Enter Message"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('msg', $setting->msg) }}</textarea>
                        @error('msg')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4" x-show="is_on">
                    <!-- Background Color -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Set background color</label>
                        <div
                            class="relative flex items-center gap-3 p-2 border border-gray-200 rounded-xl bg-white shadow-sm hover:border-indigo-400 transition-all">
                            <input type="color" name="bg_color" x-model="bg_color"
                                class="h-8 w-8 cursor-pointer appearance-none border-none bg-transparent" style="border-radius:30px;">
                            <span class="text-sm font-mono text-gray-500 uppercase tracking-wider"
                                x-text="bg_color"></span>
                        </div>
                        @error('bg_color')
                            <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Set message color</label>
                        <div
                            class="relative flex items-center gap-3 p-2 border border-gray-200 rounded-xl bg-white shadow-sm hover:border-indigo-400 transition-all">
                            <input type="color" name="msg_color" x-model="msg_color"
                                class="h-8 w-8 cursor-pointer appearance-none border-none bg-transparent" style="border-radius:30px;">
                            <span class="text-sm font-mono text-gray-500 uppercase tracking-wider"
                                x-text="msg_color"></span>
                        </div>
                        @error('msg_color')
                            <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Set link text color</label>
                        <div
                            class="relative flex items-center gap-3 p-2 border border-gray-200 rounded-xl bg-white shadow-sm hover:border-indigo-400 transition-all">
                            <input type="color" name="txt_color" x-model="txt_color"
                                class="h-8 w-8 cursor-pointer appearance-none border-none bg-transparent" style="border-radius:30px;">
                            <span class="text-sm font-mono text-gray-500 uppercase tracking-wider"
                                x-text="txt_color"></span>
                        </div>
                        @error('txt_color')
                            <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mt-8" x-show="is_on">
                    <h3 class="text-sm font-semibold text-gray-900 mb-3 uppercase tracking-wider">Preview</h3>
                    <div class="w-full rounded-lg p-4 flex items-center justify-center transition-all duration-300 shadow-inner min-h-[60px]"
                        :style="`background-color: ${bg_color};`">
                        <div class="text-center">
                            <span :style="`color: ${msg_color};`" x-text="msg" class="font-medium"></span>
                            <a href="#" class="ml-2 underline font-bold" :style="`color: ${txt_color};`"
                                x-text="link_text"></a>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-4">
                    <x-button type="submit" color="bg-indigo-600" text="Save Settings" icon="save" />
                </div>
            </form>

        </div>
    </div>
</x-pannel-layout>
