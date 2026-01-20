@section('title', 'Projects')
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
                                            {{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">
                                            {{ $project->category->name ?? 'Unknown' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">
                                            {{ $project['name'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black-800">
                                            <img src="{{ $project->image ? asset('storage/' . $project->image->url) : '' }}"
                                                alt="" width="100">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black-800">
                                            {{ $project['status'] }}</td>

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


                                                <x-button type="button" icon="eye" color="bg-indigo-600"
                                                    text="Know More"
                                                    onclick="document.getElementById('moreModal-{{ $project->id }}').classList.remove('hidden')" />


                                                <a href="{{ route('project.update', ['project' => $project['id']]) }}"
                                                    class="text-sm/6 font-semibold text-white"><x-button type="button"
                                                        icon="edit" color="bg-indigo-600" text="Edit" /></a>

                                                <x-button type="button" color="bg-red-600" text="Delete"
                                                    icon="trash"
                                                    onclick="document.getElementById('deleteModal-{{ $project['id'] }}').classList.remove('hidden')" />

                                                <div id="deleteModal-{{ $project['id'] }}"
                                                    class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">

                                                    <div
                                                        class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 text-left">
                                                        <h3 class="text-lg font-semibold text-gray-900">
                                                            Delete Project
                                                        </h3>

                                                        <p class="mt-2 text-sm text-gray-600">
                                                            Are you sure you want to delete this project?
                                                        </p>

                                                        <div class="mt-6 flex justify-end gap-3">
                                                            <x-button type="button" color="bg-indigo-600"
                                                                text="Cancel" icon="cancel"
                                                                onclick="document.getElementById('deleteModal-{{ $project['id'] }}').classList.add('hidden')" />


                                                            <a
                                                                href="{{ route('project.delete', ['project' => $project['id']]) }}">
                                                                <x-button type="button" color="bg-red-600"
                                                                    text="Yes, Delete" icon="trash" /> </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="deleteUserModal-{{ $project['id'] }}"
                                                    class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">

                                                    <div
                                                        class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 text-left">
                                                        <h3 class="text-lg font-semibold text-gray-900">
                                                            Delete User
                                                        </h3>

                                                        <p class="mt-2 text-sm text-gray-600">
                                                            Are you sure you want to delete this user?
                                                        </p>

                                                        <div class="mt-6 flex justify-end gap-3">
                                                            <x-button type="button" color="bg-indigo-600"
                                                                text="Cancel" icon="cancel"
                                                                onclick="document.getElementById('deleteUserModal-{{ $project['id'] }}').classList.add('hidden')" />


                                                            <a
                                                                href="{{ route('project.user.delete', ['project' => $project['id']]) }}">
                                                                <x-button type="button" color="bg-red-600"
                                                                    text="Yes, Delete" icon="trash" /> </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="commentModal-{{ $project->id }}"
                                                    class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">

                                                    <div
                                                        class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 text-left">
                                                        <h3 class="text-lg font-semibold text-gray-900">
                                                            All Comments
                                                        </h3>

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
                                                            <x-button type="button" color="bg-indigo-600"
                                                                text="Cancel" icon="cancel"
                                                                onclick="document.getElementById('commentModal-{{ $project['id'] }}').classList.add('hidden')" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="moreModal-{{ $project->id }}"
                                                    class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">

                                                    <div
                                                        class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 text-left">
                                                        <h3 class="text-lg font-semibold text-gray-900">
                                                            Know More About {{ $project->name }}
                                                        </h3>

                                                        <div class="grid sm:grid-cols-1 lg:grid-cols-1 mt-4">
                                                            <a href="{{ route('project.details', ['project' => $project['id']]) }}"
                                                                class="text-md/6 font-semibold text-black hover:bg-gray-100 p-4">
                                                                <i class="fa-solid fa-eye"></i>&nbsp;
                                                                View Details</a>


                                                            <a href="{{ route('project.assignemployee', ['project' => $project['id']]) }}"
                                                                class="text-md/6 font-semibold text-black hover:bg-gray-100 p-4"
                                                                style="border-top: 1px solid black"><i
                                                                    class="fa-solid fa-users"></i>&nbsp;
                                                                View Employees</a>

                                                            <a href="#"
                                                                class="text-md/6 font-semibold text-black hover:bg-gray-100 p-4"
                                                                style="border-top: 1px solid black"
                                                                onclick="document.getElementById('commentModal-{{ $project->id }}').classList.remove('hidden'), document.getElementById('moreModal-{{ $project['id'] }}').classList.add('hidden')"><i
                                                                    class="fa-solid fa-comment"></i>&nbsp;View
                                                                Comments</a>

                                                            @if ($project->users)
                                                                <a href="#"
                                                                    class="text-md/6 font-semibold text-black hover:bg-gray-100 p-4"
                                                                    style="border-top: 1px solid black"
                                                                    onclick="document.getElementById('deleteUserModal-{{ $project['id'] }}').classList.remove('hidden'), document.getElementById('moreModal-{{ $project['id'] }}').classList.add('hidden')"><i
                                                                        class="fa-solid fa-user"></i>&nbsp;Delete
                                                                    Project User</a>
                                                            @else
                                                                <a href="{{ route('project.user.add', ['project' => $project['id']]) }}"
                                                                    style="border-top: 1px solid black"
                                                                    class="text-md/6 font-semibold text-black hover:bg-gray-100 p-4"><i
                                                                        class="fa-solid fa-user"></i>&nbsp;Add
                                                                    Project User</a>
                                                            @endif

                                                            <a href="{{ route('project.task.show', ['project' => $project['id']]) }}"
                                                                style="border-top: 1px solid black"
                                                                class="text-md/6 font-semibold text-black hover:bg-gray-100 p-4"><i
                                                                    class="fa-solid fa-tasks"></i>&nbsp;All Tasks</a>
                                                        </div>
                                                        <div class="mt-6 flex justify-end gap-3">
                                                            <x-button type="button" color="bg-red-600"
                                                                text="Cancel" icon="cancel"
                                                                onclick="document.getElementById('moreModal-{{ $project['id'] }}').classList.add('hidden')" />
                                                        </div>
                                                    </div>
                                                </div>
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
