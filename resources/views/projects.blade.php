@include('masterlayout.header')
<div
    class="max-w-[60rem] shadow-xl rounded-lg border-2 border-solid mt-10 border-blue-600 px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto ">
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
        <div class="flex items-center justify-end">
            <div class="p-4 md:p-6">
                <a href="{{ route('project.add') }}" class="text-sm/6 font-semibold text-white"><button type="button"
                        class="rounded-md bg-blue-600 px-3 py-2 text-lg font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">+
                        Add New Project</button></a>
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
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    #</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Name</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Image</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Status</th>
                                <th scope="col"
                                    class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                            @foreach ($projects as $project)
                                <tr>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        {{ $project['id'] }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        {{ $project['name'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                        <img src="{{ asset('/storage/' . $project['image']) }}" alt=""
                                            width="100">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                        {{ $project['status'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <a href="{{ route('project.details', ['project' => $project['id']]) }}"
                                            class="text-sm/6 font-semibold text-white"><button type="button"
                                                class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">View
                                                Details</button></a>
                                        <a href="{{ route('project.update', ['project' => $project['id']]) }}"
                                            class="text-sm/6 font-semibold text-white"><button type="button"
                                                class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Edit</button></a>
                                        <button type="button"
                                            onclick="document.getElementById('deleteModal-{{ $project['id'] }}').classList.remove('hidden')"
                                            class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-700">
                                            Delete
                                        </button>
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
                                                    <button type="button"
                                                        onclick="document.getElementById('deleteModal-{{ $project['id'] }}').classList.add('hidden')"
                                                        class="rounded-md bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-gray-300">
                                                        Cancel
                                                    </button>

                                                    <a href="{{ route('project.delete', ['project' => $project['id']]) }}"
                                                        class="rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700">
                                                        Yes, Delete
                                                    </a>
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
