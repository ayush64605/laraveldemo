@section('title', 'User')

<x-pannel-layout>

    <section>
        <div>

            <form action="{{ route('user.save') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <h2 class="text-lg font-semibold text-gray-900">
                    {{ isset($user) ? 'Edit user' : 'Add user' }}
                </h2>

                @if (session('error'))
                    <x-alert type="error" :message="session('error')" />
                @endif
                @if (session('success'))
                    <x-alert type="success" :message="session('success')" />
                @endif

                <input type="hidden" name="id" value="{{ $user->id ?? '' }}">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Name<span class="text-red-600">*</span>
                        </label>
                        <input type="text" name="name" value="{{ $user->name ?? old('name') }}"
                            placeholder="Enter Emaployee name"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                        @error('name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Email<span class="text-red-600">*</span>
                        </label>
                        <input type="text" name="email" value="{{ $user->email ?? old('email') }}"
                            placeholder="Enter Emaployee email"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                        @error('email')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">User Image <span
                                class="text-red-600">*</span></label>
                        <input type="file" name="image"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @error('image')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>


                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-900">Role<span
                                class="text-red-600">*</span></label>
                        <div class="mt-2">
                            <div
                                class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <select name="role"
                                    class="block min-w-0 grow bg-white py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6">
                                    <option value="">Select Role</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </div>
                            @error('role')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
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
                </div>

                <div class="mt-8 flex justify-end gap-4">
                    <a href="{{ route('user.show') }}"> <x-button type="button" color="bg-red-600" text="Cancel"
                            icon="cancel" />
                    </a>
                    </a>
                    <x-button type="submit" color="bg-indigo-600" text="Save" icon="save" /> </a>
                </div>
            </form>
        </div>
    </section>

</x-pannel-layout>
