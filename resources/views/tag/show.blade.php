<x-pannel-layout>
    <div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-6">
            <div class="flex">
                <div class="p-4">
                    <h3 class="text-2xl font-semibold text-black">
                        All Tags
                    </h3>
                    <p class="mt-3 text-grey text-lg">
                        Total {{ count($tags) }} Tag(s)
                    </p>
                </div>
            </div>

            <div class="flex items-center justify-end">
                <div class="p-4 md:p-6">
                    <x-button type="button" icon="plus" color="bg-indigo-600" text="Add Tag"
                        onclick="document.getElementById('addModal').classList.remove('hidden')" />
                </div>

                <x-form-modal id="addModal" title="Add Tag" action="{{ route('tag.save') }}">
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-900">
                                Tag Name <span class="text-red-600">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                placeholder="Enter Tag name"
                                class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                            @error('name')
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
                                    <x-table.th>Name</x-table.th>
                                    <x-table.th>Total Projects</x-table.th>
                                    <x-table.th>Projects Name</x-table.th>
                                    <x-table.th>Created At</x-table.th>
                                    <x-table.th class="text-end">Action</x-table.th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @foreach ($tags as $index => $tag)
                                    <tr class="hover:bg-gray-50 transition">
                                        <x-table.td>{{ $index + 1 }}</x-table.td>
                                        <x-table.td>{{ $tag->name }}</x-table.td>
                                        <x-table.td>{{ count($tag->projects) }}</x-table.td>
                                        <x-table.td>
                                            @foreach ($tag->projects as $project)
                                                {{ $project->name }}@if(!$loop->last), @endif
                                            @endforeach
                                        </x-table.td>
                                        <x-table.td title="{{ $tag->created_at->format($setting->date_format) }}">
                                            {{ $tag->created_at->diffForHumans() }}
                                        </x-table.td>

                                        <x-table.td class="text-end">
                                            <x-button type="button" color="bg-red-600" text="Delete" icon="trash"
                                                onclick="document.getElementById('deleteModal-{{ $tag->id }}').classList.remove('hidden')" />

                                            <x-genral-modal id="deleteModal-{{ $tag->id }}" title="Delete Tag"
                                                description="Are you sure you want to delete this tag?">
                                                <div class="mt-6 flex justify-end gap-3">
                                                    <x-button type="button" color="bg-indigo-600" text="Cancel" icon="cancel"
                                                        onclick="document.getElementById('deleteModal-{{ $tag->id }}').classList.add('hidden')" />

                                                    <a href="{{ route('tag.delete', ['tag' => $tag->id]) }}">
                                                        <x-button type="button" color="bg-red-600" text="Yes, Delete" icon="trash" />
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
    </div>
</x-pannel-layout>
