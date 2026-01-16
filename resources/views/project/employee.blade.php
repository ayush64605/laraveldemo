@section('title', 'Assigned Projects')

<x-app-layout>
    <div
        class="max-w-[60rem] shadow-xl rounded-lg border-2 border-solid mt-10 border-stone-200 px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto ">
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
                                        Name </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Email </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Number </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($projects->employees as $index => $employee)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">
                                            {{ $employee->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">
                                            {{ $employee->email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black-800">
                                            {{ $employee->number }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                            <x-button type="button" color="bg-red-600" text="Delete" icon="trash"
                                                onclick="document.getElementById('deleteModal-{{ $employee->id }}').classList.remove('hidden')" />

                                            <div id="deleteModal-{{ $employee->id }}"
                                                class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">
                                                <div
                                                    class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 text-left">
                                                    <h3 class="text-lg font-semibold text-gray-900">Remove Project</h3>
                                                    <p class="mt-2 text-sm text-gray-600">Remove
                                                        <b>{{ $employee->name }}</b>
                                                        from <b>{{ $projects->name }}</b>?
                                                    </p>
                                                    <div class="mt-6 flex justify-end gap-3">
                                                        <button type="button"
                                                            onclick="document.getElementById('deleteModal-{{ $employee->id }}').classList.add('hidden')">Cancel</button>
                                                        <a
                                                            href="{{ route('employee-project.delete', ['employee' => $employee->id, 'project' => $projects->id]) }}">
                                                            <x-button type="button" color="bg-red-600"
                                                                icon="trash" text="Yes, Delete" />
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">
                                            No projects currently assigned to this employee.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
