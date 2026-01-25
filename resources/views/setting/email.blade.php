<x-pannel-layout>
    <h1 class="text-2xl font-bold mb-4 p-4">Email Settings</h1>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

        @include('setting.settingsidebar')

        <div class="p-6 border border-gray-200 rounded-md bg-white shadow-sm col-span-4">

            <form action="{{ route('setting.email_save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id">

                <section class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-2">SMTP Settings</h2>
                    <p class="text-gray-500 text-sm mb-4">Configure your SMTP server to send emails from your site.</p>

                    @if (session('error'))
                        <x-alert type="error" :message="session('error')" class="mb-4" />
                    @endif
                    @if (session('success'))
                        <x-alert type="success" :message="session('success')" class="mb-4" />
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-900 mb-1">SMTP Host</label>
                            <input type="text" name="smtp_host" placeholder="Enter SMTP Host"
                                class="border-gray-300 w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                value="{{ $setting->smtp_host }}">
                            @error('smtp_host')
                                <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-900 mb-1">SMTP Port</label>
                            <input type="text" name="smtp_port" placeholder="Enter SMTP Port"
                                class="border-gray-300 w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                value="{{ $setting->smtp_port }}">
                            @error('smtp_port')
                                <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-900 mb-1">Encryption</label>
                            <input type="text" name="encryption" placeholder="Enter Encryption"
                                class="border-gray-300 w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                value="{{ $setting->encryption }}">
                            @error('encryption')
                                <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-900 mb-1">SMTP Username</label>
                            <input type="text" name="smtp_username" placeholder="Enter SMTP Username"
                                class="border-gray-300 w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                value="{{ $setting->smtp_username }}">
                            @error('smtp_username')
                                <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-900 mb-1">SMTP Password</label>
                            <input type="password" name="smtp_password" placeholder="Enter SMTP Password"
                                class="border-gray-300 w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                value="{{ $setting->smtp_password }}">
                            @error('smtp_password')
                                <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </section>

                <section class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-2">Default Sender</h2>
                    <p class="text-gray-500 text-sm mb-4">Specify the default sender name and email for outgoing emails.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-900 mb-1">Sender Name</label>
                            <input type="text" name="sender" placeholder="Enter Sender Name"
                                class="border-gray-300 w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                value="{{ $setting->sender }}">
                            @error('sender')
                                <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-900 mb-1">Sender Email</label>
                            <input type="text" name="sender_email" placeholder="Enter Sender Email"
                                class="border-gray-300 w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                value="{{ $setting->sender_email }}">
                            @error('sender_email')
                                <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </section>

                <section class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-2">Test Email</h2>
                    <p class="text-gray-500 text-sm mb-4">Send a test email to verify your SMTP configuration is correct.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-end">
                        <div>
                            <input type="text" name="test_email" placeholder="Enter test email address"
                                class="border-gray-300 w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('test_email')
                                <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex gap-4">
                            <x-button type="submit" color="bg-indigo-500" text="Send Test" icon="check" />
                        </div>
                    </div>
                </section>

                <div class="flex justify-end">
                    <x-button type="submit" color="bg-indigo-600" text="Save Settings" icon="save" />
                </div>

            </form>
        </div>
    </div>
</x-pannel-layout>
