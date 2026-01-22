
<x-pannel-layout>
    <div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-6">
            <div class=" flex">
                <div class="p-4 md:p-6">
                    <h3 class="text-2xl font-semibold text-black">
                        All users
                    </h3>
                    <p class="mt-3 text-grey text-lg">
                        Total {{ count($users) }} users
                    </p>
                </div>
            </div>
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
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        #</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Name </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Email</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Role</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($users as $index => $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">
                                            {{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">
                                            {{ $user->name ?? 'Unknown' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">
                                            {{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">
                                            {{ $user->role }}</td>

                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                            <a href="{{ route('user.update', ['user' => $user->id]) }}"
                                                class="text-sm/6 font-semibold text-white"><x-button type="button"
                                                    icon="edit" color="bg-indigo-600" text="Edit" /></a>
                                            <x-button type="button" color="bg-red-600" text="Delete" icon="trash"
                                                onclick="document.getElementById('deleteModal-{{ $user->id }}').classList.remove('hidden')" />

                                            <x-genral-modal id="deleteModal-{{ $user->id }}" title="Delete user"
                                                description="Are you sure you want to delete this user?">

                                                <div class="mt-6 flex justify-end gap-3">
                                                    <x-button type="button" color="bg-indigo-600" text="Cancel"
                                                        icon="cancel"
                                                        onclick="document.getElementById('deleteModal-{{ $user->id }}').classList.add('hidden')" />


                                                    <a href="{{ route('user.delete', ['user' => $user->id]) }}">
                                                        <x-button type="button" color="bg-red-600" text="Yes, Delete"
                                                            icon="trash" /> </a>
                                                </div>
                                            </x-genral-modal>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-pannel-layout>
