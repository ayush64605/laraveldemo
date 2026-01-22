<x-pannel-layout>
    <div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-6">
            <div class=" flex">
                <div class="p-4 md:p-6">
                    <h3 class="text-2xl font-semibold text-black">
                        All Projects
                    </h3>
                    <p class="mt-3 text-grey text-lg">
                        Total {{ count($projects) }} Projects
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
                                        Category </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Name</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Image</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Status</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($projects as $index => $project)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">
                                            {{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">
                                            {{ $project->projects->category->name ?? 'Unknown' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">
                                            {{ $project->projects->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black-800">
                                            <img src="{{ $project->projects->image ? asset('storage/' . $project->projects->image->url) : '' }}"
                                                alt="" width="100">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black-800">
                                            {{ $project->projects->status }}</td>


                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">

                                            <a href="{{ route('project.task.show', ['project' => $project->projects->id]) }}"
                                                class="text-sm/6 font-semibold text-white"><x-button type="button"
                                                    icon="tasks" color="bg-indigo-600" text="All Tasks" /></a>

                                            <x-button type="button" icon="plus" color="bg-indigo-600"
                                                text="Add Comments"
                                                onclick="document.getElementById('addComment-{{ $project->projects->id }}').classList.remove('hidden')" />
                                        </td>
                                        <x-form-modal id="addComment-{{ $project->projects->id }}" title="Add Comment"
                                            action="{{ route('comment.save') }}">
                                            <input type="hidden" name="project" value="{{ $project->projects->id }}">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-900">Comment<span
                                                        class="text-red-600">*</span>
                                                </label>
                                                <input type="text" name="comment" placeholder="Enter comment"
                                                    class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                                                @error('comment')
                                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </x-form-modal>
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
