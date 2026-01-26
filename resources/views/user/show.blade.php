<x-pannel-layout>
    <x-card>
        <div class="flex justify-between items-center">
            <div class="p-4">
                <h3 class="text-2xl font-semibold text-black">
                    All Users
                </h3>
                <p class="mt-3 text-grey text-lg">
                    Total {{ count($users) }} users
                </p>
            </div>

            @if (checkPermission('user.create'))
                <div class="p-2">
                    <a href="{{ route('user.add') }}">
                        <x-button type="button" icon="plus" color="bg-indigo-600" text="Add User" />
                    </a>
                </div>
            @endif
        </div>

        @if (session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif
        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        <div class="flex flex-col mt-5">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                        <table class="min-w-full divide-y divide-gray-200">

                            <thead class="bg-gray-50">
                                <tr>
                                    <x-table.th>#</x-table.th>
                                    <x-table.th>Name</x-table.th>
                                    <x-table.th>Email</x-table.th>
                                    <x-table.th>Role</x-table.th>
                                    <x-table.th>Created At</x-table.th>
                                    <x-table.th class="text-end">Action</x-table.th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @foreach ($users as $index => $user)
                                    <tr class="hover:bg-gray-50 transition">
                                        <x-table.td>{{ $index + 1 }}</x-table.td>
                                        <x-table.td class="font-medium">{{ $user->name ?? 'Unknown' }}</x-table.td>
                                        <x-table.td>{{ $user->email }}</x-table.td>
                                        <x-table.td>
                                            {{ $user->roles->pluck('name')->join(',') ?? 'admin' }}
                                        </x-table.td>

                                        <x-table.td title="{{ $user->created_at->format($setting->date_format) }}">
                                            {{ $user->created_at->diffForHumans() }}
                                        </x-table.td>

                                        <x-table.td class="text-end">
                                            <div class="inline-flex flex-wrap gap-2 justify-end">

                                                @if (checkPermission('user.edit'))
                                                    <a href="{{ route('user.add', ['user' => $user->id]) }}">
                                                        <x-button type="button" icon="edit" color="bg-indigo-600"
                                                            text="Edit" />
                                                    </a>
                                                @endif
                                                @if (checkPermission('user.delete'))
                                                    <x-button type="button" color="bg-red-600" text="Delete"
                                                        icon="trash"
                                                        onclick="document.getElementById('deleteModal-{{ $user->id }}').classList.remove('hidden')" />
                                                @endif

                                            </div>

                                            <x-genral-modal id="deleteModal-{{ $user->id }}" title="Delete User"
                                                description="Are you sure you want to delete this user?">
                                                <div class="mt-6 flex justify-end gap-3">
                                                    <x-button type="button" color="bg-indigo-600" text="Cancel"
                                                        icon="cancel"
                                                        onclick="document.getElementById('deleteModal-{{ $user->id }}').classList.add('hidden')" />

                                                    <a href="{{ route('user.delete', ['user' => $user->id]) }}">
                                                        <x-button type="button" color="bg-red-600" text="Yes, Delete"
                                                            icon="trash" />
                                                    </a>
                                                </div>
                                            </x-genral-modal>
                                        </x-table.td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-card>
</x-pannel-layout>
