<x-pannel-layout>
    <style>
        .after\:left-0\.5:after {
            top: 16px
        }
    </style>
    <div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-6">
            <div class=" flex">
                <div class="p-4 md:p-6">
                    <h3 class="text-2xl font-semibold text-black">
                        Add User
                    </h3>
                </div>
            </div>

        </div>
        @if (session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif
        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif
        <div class="grid grid-cols-2 md:grid-cols-2 gap-6">
            <div class="p-4 mt-4 h-fit border border-solid rounded-md border-gray-200 nav-link">
                <form action="{{ route('user.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <h2 class="text-lg font-semibold text-gray-900">
                        Add User
                    </h2>

                    @if (session('error'))
                        <x-alert type="error" :message="session('error')" />
                    @endif
                    @if (session('success'))
                        <x-alert type="success" :message="session('success')" />
                    @endif

                    <div class="grid grid-cols-2 md:grid-cols-2 gap-6 mt-4">

                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-900 mb-2">Profile Image</label>
                            <div class="flex items-center gap-5">
                                <div class="relative">
                                    <img id="image-preview" src="{{ asset('assets/images/user.png') }}" alt="Profile"
                                        class="w-20 rounded-full h-20 object-cover border-2 border-gray-100 shadow-sm"
                                        width="80">
                                </div>

                                <div class="flex flex-col gap-2">
                                    <label for="image-input"
                                        class="cursor-pointer inline-flex items-center px-4 py-2 bg-indigo-50 text-indigo-700 text-xs font-semibold rounded-md border border-indigo-200 hover:bg-indigo-100 transition">
                                        <svg xmlns="http://www.w3.org" class="h-4 w-4 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                        </svg>
                                        Change
                                    </label>
                                    <input type="file" name="image" id="image-input" class="hidden"
                                        accept="image/*" onchange="previewImage(this)">
                                    <p class="text-xs text-gray-500">Allowed JPG, PNG. Max size 2MB</p>
                                </div>
                            </div>
                            @error('image')
                                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>


                        <div>
                            <label class="block text-sm font-medium text-gray-900">Name<span
                                    class="text-red-600">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                placeholder="Enter Emaployee name"
                                class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                            @error('name')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-900">Email<span
                                    class="text-red-600">*</span>
                            </label>
                            <input type="text" name="email" value="{{ old('email') }}"
                                placeholder="Enter Emaployee email"
                                class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                            @error('email')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-900">Password<span
                                    class="text-red-600">*</span>
                            </label>
                            <input type="text" name="password" placeholder="Leave blank if as it is"
                                class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                            @error('password')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-900">Confirm Password<span
                                    class="text-red-600">*</span>
                            </label>
                            <input type="text" name="password" placeholder="Leave blank if as it is"
                                class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                            @error('password')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-4">
                        <x-button type="submit" color="bg-indigo-600" text="Save" icon="save" />
                    </div>
                </form>
            </div>

            <div class="p-4 mt-4 border h-fit border-solid rounded-md border-gray-200 nav-link">
                <h3 class="text-xl font-semibold text-black pb-2 border-b">
                    Roles & Permissions
                </h3>
                <form action="{{ route('setting.captcha_save') }}" method="POST" enctype="multipart/form-data"
                    class="mt-4" x-data="{ is_on: false }">
                    @csrf

                    <div class="flex justify-between">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">Administrator Access</h2>
                            <p class="text-gray-500">Administrator users have unrestricted access to all feature and functions.</p>
                        </div>

                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="status" value="on" x-model="is_on" class="sr-only peer">
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

                    <div class="mt-4" x-show="!is_on">
                        <div>
                            <label class="block text-sm font-medium text-gray-900">Role Name <span
                                    class="text-red-600">*</span>
                            </label>
                            <input type="text" name="name" placeholder="Enter role Name"
                                class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                            @error('name')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <table class="min-w-full divide-y divide-gray-300 mt-4">
                            @php
                                $features = ['Project', 'Employee', 'User', 'Tags'];
                                $capabilities = ['Create', 'Delete', 'Edit', 'View'];
                            @endphp
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Features</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Capabilities </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y  divide-gray-300">
                                @foreach ($features as $feature)
                                    <tr class="divide-x">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">
                                            {{ $feature }}</td>

                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800 flex gap-4">
                                            @foreach ($capabilities as $cap)
                                                <label class="flex items-center gap-2 text-sm">
                                                    <input type="checkbox" name="capabilities[]"
                                                        value="{{ $cap }}">{{ $cap }}
                                                </label>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 border border-gray-200 rounded-md p-4 bg-gray-50" x-show="is_on">
                        <h2 class="text-md font-semibold">
                            Administrator information
                        </h2>
                        <p class="text-sm">Administrator have full access of all feature and setting of system.</p>
                    </div>

                    <div class="mt-8 flex justify-end gap-4">
                        <x-button type="submit" color="bg-indigo-600" text="Save" icon="save" />
                    </div>

                </form>
            </div>
        </div>

    </div>
    <script>
        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</x-pannel-layout>
