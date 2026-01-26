<x-pannel-layout>
    <x-card>
        <div class="grid sm:grid-cols-2 gap-6">
            <div class="flex">
                <div class="p-4">
                    <h3 class="text-2xl font-semibold text-black">All Projects</h3>
                    <p class="mt-3 text-grey text-lg">
                        Total {{ count($projects) }} Projects
                    </p>
                </div>
            </div>

            <div class="flex flex-wrap gap-3 justify-start sm:justify-end items-center">

                <form action="{{ route('project.show') }}" method="GET" id="filterForm">
                    @php $tags = App\Models\Tag::all(); @endphp
                    <select name="tag_id" onchange="this.form.submit()"
                        class="rounded-md bg-white px-3 py-2 border border-gray-300 text-sm w-36">
                        <option value="">All Tags</option>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" {{ request('tag_id') == $tag->id ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </form>

                @if (checkPermission('project.edit'))
                    <a href="{{ route('project.add') }}">
                        <x-button icon="plus" color="bg-indigo-600" text="Add Project" type="button" />
                    </a>
                @endif

                <a href="{{ route('projectcategory.show') }}">
                    <x-button icon="plus" color="bg-indigo-600" text="Project Category" type="button" />
                </a>
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
                                    <x-table.th>#</x-table.th>
                                    <x-table.th>Category</x-table.th>
                                    <x-table.th>Name</x-table.th>
                                    <x-table.th>Image</x-table.th>
                                    <x-table.th>Status</x-table.th>
                                    <x-table.th>User</x-table.th>
                                    <x-table.th>Created</x-table.th>
                                    <x-table.th class="text-right">Action</x-table.th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($projects as $index => $project)
                                    <tr class="hover:bg-gray-50 transition">

                                        <x-table.td>{{ $index + 1 }}</x-table.td>

                                        <x-table.td>
                                            {{ $project->category->name ?? 'Unknown' }}
                                        </x-table.td>

                                        <x-table.td class="font-medium">
                                            {{ $project->name }}
                                        </x-table.td>

                                        <x-table.td>
                                            @if ($project->image)
                                                <img src="{{ asset('storage/' . $project->image->url) }}"
                                                    class="h-12 w-20 object-cover rounded border">
                                            @endif
                                        </x-table.td>

                                        <x-table.td>
                                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100">
                                                {{ $project->status }}
                                            </span>
                                        </x-table.td>

                                        <x-table.td>
                                            @if ($project->users)
                                                <div>
                                                    <div class="font-medium">{{ $project->users->name }}</div>
                                                    <div class="text-xs text-gray-500">{{ $project->users->email }}
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-gray-400">Not Added</span>
                                            @endif
                                        </x-table.td>

                                        <x-table.td title="{{ $project->created_at->format($setting->date_format) }}">
                                            {{ $project->created_at->diffForHumans() }}
                                        </x-table.td>

                                        <x-table.td class="text-right">
                                            <div class="inline-flex items-center gap-2">

                                                @if (checkPermission('project.edit'))
                                                    <a href="{{ route('project.update', $project->id) }}">
                                                        <x-button icon="edit" color="bg-indigo-600" text="Edit"
                                                            type="button" />
                                                    </a>
                                                @endif

                                                @if (checkPermission('project.delete'))
                                                    <x-button icon="trash" color="bg-red-600" text="Delete"
                                                        type="button"
                                                        onclick="document.getElementById('deleteModal-{{ $project->id }}').classList.remove('hidden')" />
                                                @endif

                                                @if (hasRole('admin'))
                                                    <button
                                                        onclick="document.getElementById('moreModal-{{ $project->id }}').classList.remove('hidden')"
                                                        class="pl-2 text-gray-600 hover:text-black">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                @endif
                                            </div>

                                            <x-genral-modal id="deleteModal-{{ $project->id }}" title="Delete Project"
                                                description="Are you sure you want to delete this Project?">

                                                <div class="mt-6 flex justify-end gap-3">
                                                    <x-button type="button" color="bg-indigo-600" text="Cancel"
                                                        icon="cancel"
                                                        onclick="document.getElementById('deleteModal-{{ $project->id }}').classList.add('hidden')" />


                                                    <a
                                                        href="{{ route('project.delete', ['project' => $project->id]) }}">
                                                        <x-button type="button" color="bg-red-600" text="Yes, Delete"
                                                            icon="trash" /> </a>
                                                </div>

                                            </x-genral-modal>
                                            <x-genral-modal id="deleteUserModal-{{ $project->id }}"
                                                title="Delete User"
                                                description="Are you sure you want to delete this user?">

                                                <div class="mt-6 flex justify-end gap-3">
                                                    <x-button type="button" color="bg-indigo-600" text="Cancel"
                                                        icon="cancel"
                                                        onclick="document.getElementById('deleteUserModal-{{ $project->id }}').classList.add('hidden')" />


                                                    <a
                                                        href="{{ route('project.user.delete', ['project' => $project->id]) }}">
                                                        <x-button type="button" color="bg-red-600" text="Yes, Delete"
                                                            icon="trash" /> </a>
                                                </div>
                                            </x-genral-modal>
                                            <x-genral-modal id="commentModal-{{ $project->id }}" title="All Comments">
                                                <p class="mt-2 text-sm text-gray-600">
                                                    @foreach ($project->comments as $comment)
                                                        <ul>
                                                            <li>
                                                                {{ $comment->body }}
                                                            </li>
                                                        </ul>
                                                    @endforeach
                                                </p>
                                                <div class="mt-6 flex justify-end gap-3">
                                                    <x-button type="button" color="bg-indigo-600" text="Cancel"
                                                        icon="cancel"
                                                        onclick="document.getElementById('commentModal-{{ $project->id }}').classList.add('hidden')" />
                                                </div>
                                            </x-genral-modal>


                                            <x-form-modal id="addUser-{{ $project->id }}"
                                                title="Add user in {{ $project->name }}"
                                                action="{{ route('project.user.save', ['project' => $project->id]) }}">
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">

                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-900">User
                                                            Name <span class="text-red-600">*</span>
                                                        </label>
                                                        <input type="text" name="name"
                                                            placeholder="Enter User name"
                                                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                                                        @error('name')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-900">User
                                                            Email<span class="text-red-600">*</span>
                                                        </label>
                                                        <input type="text" name="email"
                                                            placeholder="Enter User Email"
                                                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                                                        @error('email')
                                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                </div>
                                            </x-form-modal>

                                            <x-genral-modal id="moreModal-{{ $project->id }}"
                                                title=" Know More About {{ $project->name }}">
                                                <div class="grid sm:grid-cols-1 lg:grid-cols-1 mt-4">
                                                    <a href="{{ route('project.details', ['project' => $project->id]) }}"
                                                        class="text-md/6 font-semibold text-black hover:bg-gray-100 p-4">
                                                        <i class="fa-solid fa-eye"></i>&nbsp;
                                                        View Details</a>


                                                    <a href="{{ route('project.assignemployee', ['project' => $project->id]) }}"
                                                        class="text-md/6 font-semibold text-black hover:bg-gray-100 p-4"
                                                        style="border-top: 1px solid black"><i
                                                            class="fa-solid fa-users"></i>&nbsp;
                                                        View Employees</a>

                                                    <a href="#"
                                                        class="text-md/6 font-semibold text-black hover:bg-gray-100 p-4"
                                                        style="border-top: 1px solid black"
                                                        onclick="document.getElementById('commentModal-{{ $project->id }}').classList.remove('hidden'), document.getElementById('moreModal-{{ $project->id }}').classList.add('hidden')"><i
                                                            class="fa-solid fa-comment"></i>&nbsp;View
                                                        Comments</a>

                                                    @if ($project->users)
                                                        <a href="#"
                                                            class="text-md/6 font-semibold text-black hover:bg-gray-100 p-4"
                                                            style="border-top: 1px solid black"
                                                            onclick="document.getElementById('deleteUserModal-{{ $project->id }}').classList.remove('hidden'), document.getElementById('moreModal-{{ $project->id }}').classList.add('hidden')"><i
                                                                class="fa-solid fa-user"></i>&nbsp;Delete
                                                            Project User</a>
                                                    @else
                                                        <a href="#" style="border-top: 1px solid black"
                                                            class="text-md/6 font-semibold text-black hover:bg-gray-100 p-4"
                                                            onclick="document.getElementById('addUser-{{ $project->id }}').classList.remove('hidden'), document.getElementById('moreModal-{{ $project->id }}').classList.add('hidden')"><i
                                                                class="fa-solid fa-user"></i>&nbsp;Add
                                                            Project User</a>
                                                    @endif

                                                    <a href="{{ route('project.task.show', ['project' => $project->id]) }}"
                                                        style="border-top: 1px solid black"
                                                        class="text-md/6 font-semibold text-black hover:bg-gray-100 p-4"><i
                                                            class="fa-solid fa-tasks"></i>&nbsp;All
                                                        Tasks</a>
                                                </div>
                                                <div class="mt-6 flex justify-end gap-3">
                                                    <x-button type="button" color="bg-red-600" text="Cancel"
                                                        icon="cancel"
                                                        onclick="document.getElementById('moreModal-{{ $project->id }}').classList.add('hidden')" />
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
