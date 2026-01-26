<x-pannel-layout>
    <x-card>
        <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-6">
            <div class=" flex">
                <div class="p-4 md:p-6">
                    <h3 class="text-2xl font-semibold text-black">
                        All Assigned Employee
                    </h3>
                    <p class="mt-3 text-grey text-lg">
                        Total {{ count($projects->employees) }} Assigned Employee
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
        <div class="flex flex-col ">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                        <table class="min-w-full divide-y divide-gray-200">

                            <thead class="bg-gray-50 sticky top-0 z-10">
                                <tr>
                                    <x-table.th>
                                        #</x-table.th>
                                    <x-table.th>
                                        Name </x-table.th>
                                    <x-table.th>
                                        Email </x-table.th>
                                    <x-table.th>
                                        Number </x-table.th>
                                    <x-table.th>
                                        Action</x-table.th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($projects->employees as $index => $employee)
                                    <tr>
                                        <x-table.td>
                                            {{ $index + 1 }}
                                        </x-table.td>
                                        <x-table.td>
                                            {{ $employee->name }}
                                        </x-table.td>
                                        <x-table.td>
                                            {{ $employee->email }}
                                        </x-table.td>
                                        <x-table.td>
                                            {{ $employee->number }}
                                        </x-table.td>
                                        <x-table.td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                            <x-button type="button" color="bg-red-600" text="Delete" icon="trash"
                                                onclick="document.getElementById('deleteModal-{{ $employee->id }}').classList.remove('hidden')" />

                                            <x-genral-modal id="deleteModal-{{ $employee->id }}" title="Remove Project"
                                                description="Remove
                                                        {{ $employee->name }}
                                                        from {{ $projects->name }}?">

                                                <div class="mt-6 flex justify-end gap-3">
                                                    <x-button type="button" color="bg-indigo-600" text="Cancel"
                                                        icon="cancel"
                                                        onclick="document.getElementById('deleteModal-{{ $employee->id }}').classList.add('hidden')" />


                                                    <a
                                                        href="{{ route('employee-project.delete', ['employee' => $employee->id, 'project' => $projects->id]) }}">
                                                        <x-button type="button" color="bg-red-600" text="Yes, Delete"
                                                            icon="trash" /> </a>
                                                </div>

                                            </x-genral-modal>
                                        </x-table.td>
                                    </tr>
                                @empty
                                    <tr>
                                        <x-table.td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">
                                            No projects currently assigned to this employee.
                                        </x-table.td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-card>
</x-pannel-layout>
