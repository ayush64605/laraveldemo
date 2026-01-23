<x-pannel-layout>
    <div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-6">
            <div class=" flex">
                <div class="p-4 md:p-6">
                    <h3 class="text-2xl font-semibold text-black">
                        Add Role
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
        <div class="grid grid-cols-3 md:grid-cols-3 gap-6">
            <div class="p-4 mt-4 border border-solid rounded-md border-gray-200 nav-link col-span-2">
                <form action="">
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

                    <div class="mt-8 flex justify-end gap-4">
                        <x-button type="submit" color="bg-indigo-600" text="Save Project" icon="save" />
                    </div>

                </form>
            </div>
            <div class="p-4 mt-4 border border-solid rounded-md border-gray-200 nav-link">
                <h3 class="text-xl font-semibold text-black pb-2 border-b">
                    List of user using this role
                </h3>
            </div>
        </div>

    </div>
</x-pannel-layout>
