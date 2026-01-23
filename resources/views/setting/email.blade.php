<x-pannel-layout>
    <h1 class="text-2xl font-bold">Email Settings</h1>
    <div class="grid grid-cols-5 gap-4">
        @include('setting.settingsidebar')
        <div class="p-4 mt-4 border border-solid h-fit border-gray-200 col-span-4">

            <form action="{{ route('setting.email_save') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id">

                <h2 class="text-lg font-semibold text-gray-900">
                    SMTP Setting
                </h2>

                @if (session('error'))
                    <x-alert type="error" :message="session('error')" />
                @endif
                @if (session('success'))
                    <x-alert type="success" :message="session('success')" />
                @endif
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-900">SMTP Host
                        </label>
                        <input type="text" name="smtp_host" placeholder="Enter SMTP Host"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            value="{{ $setting->smtp_host }}">
                        @error('smtp_host')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">SMTP Port
                        </label>
                        <input type="text" name="smtp_port" placeholder="Enter SMTP Port"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            value="{{ $setting->smtp_port }}">
                        @error('smtp_port')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Encryption
                        </label>
                        <input type="text" name="encryption" placeholder="Enter Encryption"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            value="{{ $setting->encryption }}">
                        @error('encryption')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">SMTP Username
                        </label>
                        <input type="text" name="smtp_username" placeholder="Enter SMTP Username"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            value="{{ $setting->smtp_username }}">
                        @error('smtp_username')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">SMTP Password
                        </label>
                        <input type="password" name="smtp_password" placeholder="Enter SMTP Password"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            value="{{ $setting->smtp_password }}">
                        @error('smtp_password')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <hr class="mt-4">
                <h2 class="text-lg font-semibold text-gray-900 mt-4">
                    Default Sender
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-900">Sender Name
                        </label>
                        <input type="text" name="sender" placeholder="Enter Sender Name"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            value="{{ $setting->sender }}">
                        @error('sender')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Sender Mail
                        </label>
                        <input type="text" name="sender_email" placeholder="Enter Sender Mail"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            value="{{ $setting->sender_email }}">
                        @error('sender_email')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <hr class="mt-4">
                <h2 class="text-lg font-semibold text-gray-900 mt-4">
                    Default Sender
                </h2>
                <p class="text-gray-500">Send test mail to make sure that your SMTP setting is set correctly.</p>
                <div class="mt-4 flex items-center gap-4">
                    <div class="w-full">
                        <input type="text" name="test_email" placeholder="Enter mail address for testing"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @error('test_email')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex justify-end gap-4">
                        <x-button type="submit" color="bg-indigo-600" text="Test" icon="check" />
                    </div>
                </div>


                <div class="mt-8 flex justify-end gap-4">
                    <x-button type="submit" color="bg-indigo-600" text="Save" icon="save" />
                </div>
            </form>
        </div>
    </div>
</x-pannel-layout>
