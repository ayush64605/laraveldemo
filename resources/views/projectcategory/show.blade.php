<x-pannel-layout>
    <x-card>
        <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-6">
            <div class="flex">
                <div class="p-4">
                    <h3 class="text-2xl font-semibold text-black">
                        All Project Categories
                    </h3>
                    <p class="mt-3 text-grey text-lg">
                        Total {{ count($projectcategories) }} Project Categories
                    </p>
                </div>
            </div>
            <div class="flex items-center justify-end">
                <div class="p-4 md:p-6">
                    <x-button type="button" icon="plus" color="bg-indigo-600" text="Add Project Category"
                        onclick="document.getElementById('addProjectCategoryModal').classList.remove('hidden')" />
                </div>

                <x-form-modal id="addProjectCategoryModal" title="Add Project Category"
                    action="{{ route('projectcategory.save') }}">
                    <div>
                        <label class="block text-sm font-medium text-gray-900">Project Category Name
                            <span class="text-red-600">*</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            placeholder="Enter project category name"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @error('name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
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
                                    <x-table.th>Name</x-table.th>
                                    <x-table.th>Total Projects</x-table.th>
                                    <x-table.th>Projects Name</x-table.th>
                                    <x-table.th class="text-end">Action</x-table.th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($projectcategories as $index => $projectcategory)
                                    <tr class="hover:bg-gray-50 transition">
                                        <x-table.td>{{ $index + 1 }}</x-table.td>
                                        <x-table.td>{{ $projectcategory->name }}</x-table.td>
                                        <x-table.td>{{ count($projectcategory->projects) }}</x-table.td>
                                        <x-table.td>
                                            @foreach ($projectcategory->projects as $project)
                                                {{ $project->name }},
                                            @endforeach
                                        </x-table.td>
                                        <x-table.td class="text-end">
                                            <x-button type="button" icon="edit" color="bg-indigo-600" text="Edit"
                                                onclick="document.getElementById('editModal-{{ $projectcategory->id }}').classList.remove('hidden')" />
                                            <x-button type="button" color="bg-red-600" text="Delete" icon="trash"
                                                onclick="document.getElementById('deleteModal-{{ $projectcategory->id }}').classList.remove('hidden')" />

                                            <x-form-modal id="editModal-{{ $projectcategory->id }}"
                                                title="Edit Project Category"
                                                action="{{ route('projectcategory.save') }}">
                                                <input type="hidden" name="id"
                                                    value="{{ $projectcategory->id }}">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-900">Project
                                                        Category Name
                                                        <span class="text-red-600">*</span>
                                                    </label>
                                                    <input type="text" name="name"
                                                        value="{{ $projectcategory->name }}"
                                                        placeholder="Enter project category name"
                                                        class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                    @error('name')
                                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </x-form-modal>

                                            <x-genral-modal id="deleteModal-{{ $projectcategory->id }}"
                                                title="Delete Project Category"
                                                description="Are you sure you want to delete this project category? <br> If yes, all projects in this category will also be deleted.">
                                                <div class="mt-6 flex justify-end gap-3">
                                                    <x-button type="button" color="bg-indigo-600" text="Cancel"
                                                        icon="cancel"
                                                        onclick="document.getElementById('deleteModal-{{ $projectcategory->id }}').classList.add('hidden')" />
                                                    <a
                                                        href="{{ route('projectcategory.delete', ['projectcategory' => $projectcategory->id]) }}">
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
