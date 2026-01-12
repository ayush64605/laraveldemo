@section('title', 'Projects')

@include('masterlayout.header')
<div
    class="max-w-[100rem] shadow-xl rounded-lg border-2 border-solid mt-10 border-stone-200 px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto ">
    <div class="grid sm:grid-cols-3 lg:grid-cols-3 gap-6">
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
        <div class="flex items-center justify-end">
            <div class="p-4 md:p-6">
                <a href="{{ route('project.add') }}" class="text-sm/6 font-semibold text-white"><button type="button"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-lg font-semibold text-white shadow-xs hover:bg-indigo-500">+
                        Add New Project</button></a>
            </div>
        </div>
        <div class="flex items-center justify-end">
            <div class="p-4 md:p-6">
                <a href="{{ route('projectcategory.show') }}" class="text-sm/6 font-semibold text-white"><button
                        type="button"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-lg font-semibold text-white shadow-xs hover:bg-indigo-500">+
                        Project Category</button></a>
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
                                        <img src="{{ asset('/storage/' . $project['image']) }}" alt=""
                                            width="100">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black-800">
                                        {{ $project['status'] }}</td>

                                    @if ($project->users)
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">
                                            {{ $project->users->name ?? 'Unknown' }}
                                            ({{ $project->users->email ?? 'Unknown' }})
                                        </td>
                                    @else
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">Not
                                            Added</td>
                                    @endif

                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <a href="{{ route('project.details', ['project' => $project['id']]) }}"
                                            class="text-sm/6 font-semibold text-white"><x-button type="button"
                                                icon="eye" color="indigo" text="View Detils" /></a>
                                        @if ($project->users)
                                            <a href="{{ route('project.user.delete', ['project' => $project['id']]) }}"
                                                class="text-sm/6 font-semibold text-white"><x-button type="button"
                                                    icon="trash" color="red" text="Delete User" /></a>
                                        @else
                                            <a href="{{ route('project.user.add', ['project' => $project['id']]) }}"
                                                class="text-sm/6 font-semibold text-white"><x-button type="button"
                                                    icon="eye" color="indigo" text="Add User" /></a>
                                        @endif

                                        <a href="{{ route('project.update', ['project' => $project['id']]) }}"
                                            class="text-sm/6 font-semibold text-white"><x-button type="button"
                                                icon="edit" color="indigo" text="Edit" /></a>

                                        <x-button type="button" color="red" text="Delete" icon="trash"
                                            onclick="document.getElementById('deleteModal-{{ $project['id'] }}').classList.remove('hidden')" />

                                        <div id="deleteModal-{{ $project['id'] }}"
                                            class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">

                                            <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 text-left">
                                                <h3 class="text-lg font-semibold text-gray-900">
                                                    Delete Project
                                                </h3>

                                                <p class="mt-2 text-sm text-gray-600">
                                                    Are you sure you want to delete this project?
                                                </p>

                                                <div class="mt-6 flex justify-end gap-3">
                                                    <x-button type="button" color="indigo" text="Cancel"
                                                        icon="cancel"
                                                        onclick="document.getElementById('deleteModal-{{ $project['id'] }}').classList.add('hidden')" />


                                                    <a
                                                        href="{{ route('project.delete', ['project' => $project['id']]) }}">
                                                        <x-button type="button" color="red" text="Yes, Delete"
                                                            icon="trash" /> </a>
                                                </div>
                                            </div>
                                        </div>
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
@include('masterlayout.footer')
