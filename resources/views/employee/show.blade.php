<x-pannel-layout>
    <x-card>
        <div class="grid sm:grid-cols-2 gap-6">
            <div class="flex">
                <div class="p-4">
                    <h3 class="text-2xl font-semibold text-black">All Employees</h3>
                    <p class="mt-3 text-grey text-lg">
                        Total {{ count($employees) }} Employees
                    </p>
                </div>
            </div>

            <div class="flex items-center justify-end">
                @if (checkPermission('employee.create'))
                    <div class="p-2">
                        <x-button type="button" icon="plus" color="bg-indigo-600" text="Add Employee"
                            onclick="document.getElementById('addModal').classList.remove('hidden')" />
                    </div>
                @endif

                <x-form-modal id="addModal" title="Add Employee" action="{{ route('employee.save') }}">
                    <div class="grid grid-cols-1 gap-6 mt-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-900">
                                Name <span class="text-red-600">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="border-gray-300 w-full rounded-md shadow-sm">
                            @error('name')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-900">
                                Mobile No. <span class="text-red-600">*</span>
                            </label>
                            <input type="text" name="number" value="{{ old('number') }}"
                                class="border-gray-300 w-full rounded-md shadow-sm">
                            @error('number')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-900">
                                Email <span class="text-red-600">*</span>
                            </label>
                            <input type="text" name="email" value="{{ old('email') }}"
                                class="border-gray-300 w-full rounded-md shadow-sm">
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

        <div class="flex flex-col mt-6">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">

                        <table class="min-w-full divide-y divide-gray-200">

                            <thead class="bg-gray-50">
                                <tr>
                                    <x-table.th>#</x-table.th>
                                    <x-table.th>Name</x-table.th>
                                    <x-table.th>Email</x-table.th>
                                    <x-table.th>Number</x-table.th>
                                    <x-table.th>Created At</x-table.th>
                                    <x-table.th class="text-end">Action</x-table.th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @foreach ($employees as $index => $employee)
                                    <tr class="hover:bg-gray-50 transition">

                                        <x-table.td>
                                            {{ $index + 1 }}
                                        </x-table.td>

                                        <x-table.td class="font-medium">
                                            {{ $employee->name ?? 'Unknown' }}
                                        </x-table.td>

                                        <x-table.td>
                                            {{ $employee->email }}
                                        </x-table.td>

                                        <x-table.td>
                                            {{ $employee->number }}
                                        </x-table.td>

                                        <x-table.td title="{{ $employee->created_at->format($setting->date_format) }}">
                                            {{ $employee->created_at->diffForHumans() }}
                                        </x-table.td>

                                        <x-table.td class="text-end">
                                            <div class="inline-flex flex-wrap gap-2 justify-end">

                                                @if (checkPermission('employee.edit'))
                                                    <x-button type="button" icon="edit" color="bg-indigo-600"
                                                        text="Edit"
                                                        onclick="document.getElementById('editModal-{{ $employee->id }}').classList.remove('hidden')" />
                                                @endif

                                                @if (hasRole('admin'))
                                                    <a href="{{ route('employee-project.show', ['employee' => $employee->id]) }}"
                                                        class="text-sm/6 font-semibold text-white">
                                                        <x-button type="button" icon="eye" color="bg-indigo-600"
                                                            text="Assign Project" />
                                                    </a>
                                                @endif

                                                @if (checkPermission('employee.delete'))
                                                    <x-button type="button" color="bg-red-600" text="Delete"
                                                        icon="trash"
                                                        onclick="document.getElementById('deleteModal-{{ $employee->id }}').classList.remove('hidden')" />
                                                @endif

                                            </div>

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
                                                            icon="trash" />
                                                    </a>
                                                </div>
                                            </x-genral-modal>

                                            <x-form-modal id="editModal-{{ $employee->id }}" title="Edit Employee"
                                                action="{{ route('employee.save') }}">

                                                <input type="hidden" name="id" value="{{ $employee->id }}">

                                                <div class="grid grid-cols-1 gap-6 mt-4">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-900">
                                                            Name <span class="text-red-600">*</span>
                                                        </label>
                                                        <input type="text" name="name"
                                                            value="{{ $employee->name ?? old('name') }}"
                                                            class="border-gray-300 w-full rounded-md shadow-sm">
                                                    </div>

                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-900">
                                                            Mobile No. <span class="text-red-600">*</span>
                                                        </label>
                                                        <input type="text" name="number"
                                                            value="{{ $employee->number ?? old('number') }}"
                                                            class="border-gray-300 w-full rounded-md shadow-sm">
                                                    </div>

                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-900">
                                                            Email <span class="text-red-600">*</span>
                                                        </label>
                                                        <input type="text" name="email"
                                                            value="{{ $employee->email ?? old('email') }}"
                                                            class="border-gray-300 w-full rounded-md shadow-sm">
                                                    </div>
                                                </div>
                                            </x-form-modal>

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
