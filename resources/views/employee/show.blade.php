<x-pannel-layout>
    <div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-6">
            <div class=" flex">
                <div class="p-4 md:p-6">
                    <h3 class="text-2xl font-semibold text-black">
                        All Employees
                    </h3>
                    <p class="mt-3 text-grey text-lg">
                        Total {{ count($employees) }} Employees
                    </p>
                </div>
            </div>
            <div class="flex items-center justify-end">
                <div>
                    <div class="p-2">
                        <x-button type="button" icon="plus" color="bg-indigo-600" text="Add Employee"
                            onclick="document.getElementById('addModal').classList.remove('hidden')" />
                    </div>
                </div>
                <x-form-modal id="addModal" title="Add Employee" action="{{ route('employee.save') }}">
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-4">

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
                            <label class="block text-sm font-medium text-gray-900">Mobile No.<span
                                    class="text-red-600">*</span>
                            </label>
                            <input type="text" name="number" value="{{ old('number') }}"
                                placeholder="Enter Mobile No."
                                class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                            @error('number')
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
                    </div>
                </x-form-modal>
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
                                        Number</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Created At</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($employees as $index => $employee)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">
                                            {{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">
                                            {{ $employee->name ?? 'Unknown' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">
                                            {{ $employee->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">
                                            {{ $employee->number }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800" title="{{ $employee->created_at->format($setting->date_format) }}">
                                            {{ $employee->created_at->diffForHumans() }}</td>

                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                            <x-button type="button" icon="edit" color="bg-indigo-600" text="Edit"
                                                onclick="document.getElementById('editModal-{{ $employee->id }}').classList.remove('hidden')" />
                                            <a href="{{ route('employee-project.show', ['employee' => $employee->id]) }}"
                                                class="text-sm/6 font-semibold text-white"><x-button type="button"
                                                    icon="eye" color="bg-indigo-600" text="Assign Project" /></a>

                                            <x-button type="button" color="bg-red-600" text="Delete" icon="trash"
                                                onclick="document.getElementById('deleteModal-{{ $employee->id }}').classList.remove('hidden')" />

                                            <x-genral-modal id="deleteModal-{{ $employee->id }}"
                                                title="Delete Employee"
                                                description="Are you sure you want to delete this employee?">

                                                <div class="mt-6 flex justify-end gap-3">
                                                    <x-button type="button" color="bg-indigo-600" text="Cancel"
                                                        icon="cancel"
                                                        onclick="document.getElementById('deleteModal-{{ $employee->id }}').classList.add('hidden')" />


                                                    <a
                                                        href="{{ route('employee.delete', ['employee' => $employee->id]) }}">
                                                        <x-button type="button" color="bg-red-600" text="Yes, Delete"
                                                            icon="trash" /> </a>
                                                </div>

                                            </x-genral-modal>

                                            <x-form-modal id="editModal-{{ $employee->id }}" title="Edit Employee"
                                                action="{{ route('employee.save') }}">
                                                <input type="hidden" name="id"
                                                    value="{{ $employee->id ?? '' }}">

                                                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-4">

                                                    <div>
                                                        <label
                                                            class="block text-sm font-medium text-gray-900">Name<span
                                                                class="text-red-600">*</span>
                                                        </label>
                                                        <input type="text" name="name"
                                                            value="{{ $employee->name ?? old('name') }}"
                                                            placeholder="Enter Emaployee name"
                                                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                                                        @error('name')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-900">Mobile
                                                            No.<span class="text-red-600">*</span>
                                                        </label>
                                                        <input type="text" name="number"
                                                            value="{{ $employee->number ?? old('number') }}"
                                                            placeholder="Enter Mobile No."
                                                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                                                        @error('number')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div>
                                                        <label
                                                            class="block text-sm font-medium text-gray-900">Email<span
                                                                class="text-red-600">*</span>
                                                        </label>
                                                        <input type="text" name="email"
                                                            value="{{ $employee->email ?? old('email') }}"
                                                            placeholder="Enter Emaployee email"
                                                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                                                        @error('email')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </x-form-modal>
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
