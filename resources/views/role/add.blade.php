<x-pannel-layout>
    <div class="max-w-7xl mx-auto px-4 py-6 space-y-6">

        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h3 class="text-2xl font-semibold text-black">
                {{ isset($role) ? 'Edit Role' : 'Add Role' }}
            </h3>
        </div>

        @if (session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif
        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 bg-white border border-gray-200 rounded-lg shadow-sm p-6 space-y-6">
                <form action="{{ route('role.save', $role->id ?? null) }}" method="POST">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-900 mb-1">Role Name <span class="text-red-600">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $role->name ?? '') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('name')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-300 mt-4">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Feature</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Permissions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($permissions as $feature => $perms)
                                    <tr class="divide-x">
                                        <td class="px-6 py-4 font-medium capitalize text-gray-800">{{ $feature }}</td>
                                        <td class="px-6 py-4 flex gap-4 flex-wrap">
                                            @foreach ($perms as $perm)
                                                <label class="flex items-center gap-2 text-sm">
                                                    <input type="checkbox" name="permissions[]"
                                                           value="{{ $perm->name }}"
                                                           @checked($role && $role->hasPermissionTo($perm->name))
                                                           class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    {{ ucfirst(explode('.', $perm->name)[1]) }}
                                                </label>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-button type="submit" color="bg-indigo-600"
                                  text="{{ isset($role) ? 'Update Role' : 'Save Role' }}" icon="save"/>
                    </div>
                </form>
            </div>

            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 h-fit">
                <h3 class="text-xl font-semibold text-black pb-2 border-b mb-4">Users with this Role</h3>
                @if($role && $role->users->count())
                    <ul class="space-y-2 list-disc list-inside text-gray-800">
                        @foreach($role->users as $user)
                            <li>{{ $user->name }} ({{ $user->email }})</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">Select a role to see users.</p>
                @endif
            </div>

        </div>
    </div>
</x-pannel-layout>
