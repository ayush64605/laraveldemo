<x-pannel-layout>
    <div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-6">
            <div class="flex">
                <div class="p-4">
                    <h3 class="text-2xl font-semibold text-black">
                        All Assigned Projects
                    </h3>
                    <p class="mt-3 text-grey text-lg">
                        Total {{ count($employee->projects) }} Assigned Project(s)
                    </p>
                </div>
            </div>

            <div class="flex items-center justify-end">
                <div class="p-2">
                    <x-button type="button" icon="plus" color="bg-indigo-600" text="Assign Project"
                        onclick="document.getElementById('assignModal-{{ $employee->id }}').classList.remove('hidden')" />
                </div>

                <x-form-modal id="assignModal-{{ $employee->id }}" title="Assign Project"
                    action="{{ route('employee-project.save', ['employee' => $employee]) }}">
                    <div class="grid grid-cols-1 gap-6 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-900">
                                Project <span class="text-red-600">*</span>
                            </label>
                            <select name="project"
                                class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Select Project</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                            @error('project')
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
                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                        <table class="min-w-full divide-y divide-gray-200">

                            <thead class="bg-gray-50">
                                <tr>
                                    <x-table.th>#</x-table.th>
                                    <x-table.th>Project Name</x-table.th>
                                    <x-table.th class="text-end">Action</x-table.th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @forelse ($employee->projects as $index => $project)
                                    <tr class="hover:bg-gray-50 transition">
                                        <x-table.td>{{ $index + 1 }}</x-table.td>
                                        <x-table.td>{{ $project->name }}</x-table.td>

                                        <x-table.td class="text-end">
                                            <x-button type="button" color="bg-red-600" text="Delete" icon="trash"
                                                onclick="document.getElementById('deleteModal-{{ $project->id }}').classList.remove('hidden')" />

                                            <x-genral-modal id="deleteModal-{{ $project->id }}" title="Remove Project"
                                                description="Remove {{ $project->name }} from {{ $employee->name }}?">
                                                <div class="mt-6 flex justify-end gap-3">
                                                    <x-button type="button" color="bg-indigo-600" text="Cancel" icon="cancel"
                                                        onclick="document.getElementById('deleteModal-{{ $project->id }}').classList.add('hidden')" />

                                                    <a href="{{ route('employee-project.delete', ['employee' => $employee->id, 'project' => $project->id]) }}">
                                                        <x-button type="button" color="bg-red-600" text="Yes, Delete" icon="trash" />
                                                    </a>
                                                </div>
                                            </x-genral-modal>
                                        </x-table.td>
                                    </tr>
                                @empty
                                    <tr>
                                        <x-table.td colspan="3" class="text-center text-gray-500">
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
    </div>
</x-pannel-layout>
