<x-pannel-layout>
    <form action="{{ route('user.save', $user->id ?? null) }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if (session('error'))
            <x-alert type="error" :message="session('error')" class="mb-4" />
        @endif
        @if (session('success'))
            <x-alert type="success" :message="session('success')" class="mb-4" />
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 h-fit space-y-6">
                <h2 class="text-lg font-semibold text-gray-900">{{ isset($user) ? 'Edit User' : 'Add User' }}</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-900 mb-2">Profile Image</label>
                        <div class="flex items-center gap-5">
                            <img id="image-preview"
                                src="{{ $user?->image?->url ? asset('storage/' . $user->image->url) : asset('assets/images/user.png') }}"
                                class="w-20 h-20 object-cover rounded-full border-2 border-gray-100 shadow-sm">
                            <div class="flex flex-col gap-2">
                                <label for="image-input"
                                    class="cursor-pointer inline-flex items-center px-4 py-2 bg-indigo-50 text-indigo-700 text-xs font-semibold rounded-md border border-indigo-200 hover:bg-indigo-100 transition">
                                    Change
                                </label>
                                <input type="file" name="image" id="image-input" class="hidden" accept="image/*"
                                    onchange="previewImage(this)">
                                <p class="text-xs text-gray-500">Allowed JPG, PNG. Max size 2MB</p>
                            </div>
                        </div>
                        @error('image')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Name <span
                                class="text-red-600">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}"
                            placeholder="Enter Name"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @error('name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Email <span
                                class="text-red-600">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}"
                            placeholder="Enter Email"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @error('email')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Password
                            {{ isset($user) ? '(Leave blank to keep)' : '*' }}</label>
                        <input type="password" name="password" placeholder="Enter password"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @error('password')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Confirm Password</label>
                        <input type="password" name="password_confirmation" placeholder="Confirm password"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @error('password_confirmation')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 space-y-6">
                <h3 class="text-xl font-semibold text-black pb-2 border-b">Roles & Permissions</h3>

                <div>
                    <label class="block text-sm font-medium">Role <span class="text-red-600">*</span></label>
                    <select name="role_id" id="roleSelect"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select Role</option>
                        @foreach ($roles as $roleItem)
                            <option value="{{ $roleItem->id }}" @selected(old('role_id', $user?->roles->first()?->id) == $roleItem->id)>
                                {{ ucfirst($roleItem->name) }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-300 mt-4">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Feature</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Capabilities
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($permissions as $feature => $perms)
                                <tr>
                                    <td class="px-6 py-4 font-medium capitalize text-gray-800">{{ $feature }}</td>
                                    <td class="px-6 py-4 flex gap-4 flex-wrap">
                                        @foreach ($perms as $perm)
                                            @php
                                                $rolePermIds =
                                                    $user?->roles->first()?->permissions->pluck('name')->toArray() ??
                                                    [];
                                                $isRolePermission = in_array($perm->name, $rolePermIds);
                                                $isExtraPermission =
                                                    $user && $user->hasPermissionTo($perm->name) && !$isRolePermission;
                                            @endphp
                                            <label class="flex items-center gap-2 text-sm">
                                                <input type="checkbox" name="permissions[]" value="{{ $perm->name }}"
                                                    class="permission-checkbox rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                    @checked($isRolePermission || $isExtraPermission) @disabled($isRolePermission)>
                                                {{ ucfirst(explode('.', $perm->name)[1]) }}
                                                @if ($isRolePermission)
                                                    <small class="text-gray-400">(role)</small>
                                                @endif
                                            </label>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex justify-end gap-4">
                    <x-button type="submit" color="bg-indigo-600"
                        text="{{ isset($user) ? 'Update User' : 'Save User' }}" icon="save" />
                </div>
            </div>
        </div>
    </form>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => preview.src = e.target.result;
                reader.readAsDataURL(input.files[0]);
            }
        }

        const rolePermissions = @json($roles->mapWithKeys(fn($r) => [$r->id => $r->permissions->pluck('name')]));

        document.getElementById('roleSelect').addEventListener('change', function() {
            const selectedPerms = rolePermissions[this.value] || [];
            document.querySelectorAll('.permission-checkbox').forEach(cb => {
                if (selectedPerms.includes(cb.value)) {
                    cb.checked = true;
                    cb.disabled = true;
                } else {
                    cb.disabled = false;
                }
            });
        });
    </script>
</x-pannel-layout>
