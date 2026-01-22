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
            @if (Auth::user()->role == 'admin')
                <div class="flex items-center justify-end">
                    <form action="{{ route('project.show') }}" method="GET" id="filterForm">
                        <div>
                            @php
                                $tags = App\Models\Tag::all();
                            @endphp
                            <select name="tag_id" onchange="document.getElementById('filterForm').submit()"
                                class="block w-full rounded-md bg-white px-3 py-2 outline outline-1 outline-gray-300"
                                style="width: 120px">
                                <option value="">All Tags</option>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}"
                                        {{ request('tag_id') == $tag->id ? 'selected' : '' }}>
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>

                    <div>
                        <div class="p-2">
                            <a href="{{ route('project.add') }}" class="text-sm/6 font-semibold text-white"><x-button
                                    type="button" icon="plus" color="bg-indigo-600" text="Add Project" /></a>
                        </div>
                    </div>
                    <div>
                        <div class="p-2">
                            <a href="{{ route('projectcategory.show') }}"
                                class="text-sm/6 font-semibold text-white"><x-button type="button" icon="plus"
                                    color="bg-indigo-600" text="Project Category" /></a>
                        </div>
                    </div>
                </div>
            @endif
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
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        User</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($projects as $index => $project)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">
                                            {{ $project->category->name ?? 'Unknown' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">
                                            {{ $project['name'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black-800">
                                            <img src="{{ $project->image ? asset('storage/' . $project->image->url) : '' }}"
                                                alt="" width="100">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black-800">
                                            {{ $project['status'] }}
                                        </td>

                                        @if ($project->users)
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">
                                                {{ $project->users->name ?? 'Unknown' }}
                                                ({{ $project->users->email ?? 'Unknown' }})
                                            </td>
                                        @else
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">
                                                Not
                                                Added</td>
                                        @endif

                                        @if (Auth::user()->role == 'admin')
                                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">

                                                <a href="{{ route('project.update', ['project' => $project->id]) }}"
                                                    class="text-sm/6 font-semibold text-white"><x-button type="button"
                                                        icon="edit" color="bg-indigo-600" text="Edit" /></a>

                                                <x-button type="button" color="bg-red-600" text="Delete"
                                                    icon="trash"
                                                    onclick="document.getElementById('deleteModal-{{ $project->id }}').classList.remove('hidden')" />

                                                <button
                                                    onclick="document.getElementById('moreModal-{{ $project->id }}').classList.remove('hidden')"
                                                    class="pl-4"><i class="fas fa-ellipsis-v"></i></button>

                                                <x-genral-modal id="deleteModal-{{ $project->id }}"
                                                    title="Delete Project"
                                                    description="Are you sure you want to delete this Project?">

                                                    <div class="mt-6 flex justify-end gap-3">
                                                        <x-button type="button" color="bg-indigo-600" text="Cancel"
                                                            icon="cancel"
                                                            onclick="document.getElementById('deleteModal-{{ $project->id }}').classList.add('hidden')" />


                                                        <a
                                                            href="{{ route('project.delete', ['project' => $project->id]) }}">
                                                            <x-button type="button" color="bg-red-600"
                                                                text="Yes, Delete" icon="trash" /> </a>
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
                                                            <x-button type="button" color="bg-red-600"
                                                                text="Yes, Delete" icon="trash" /> </a>
                                                    </div>
                                                </x-genral-modal>
                                                <x-genral-modal id="commentModal-{{ $project->id }}"
                                                    title="All Comments">
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
                                                                <span
                                                                    class="text-red-600 text-sm">{{ $message }}</span>
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
                                                                <span
                                                                    class="text-red-600 text-sm">{{ $message }}</span>
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
                                                                class="fa-solid fa-tasks"></i>&nbsp;All Tasks</a>
                                                    </div>
                                                    <div class="mt-6 flex justify-end gap-3">
                                                        <x-button type="button" color="bg-red-600" text="Cancel"
                                                            icon="cancel"
                                                            onclick="document.getElementById('moreModal-{{ $project->id }}').classList.add('hidden')" />
                                                    </div>
                                                </x-genral-modal>
                                            </td>
                                        @endif
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
