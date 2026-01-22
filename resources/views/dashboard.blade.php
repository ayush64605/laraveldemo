<x-pannel-layout>

    <div class="px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="group flex shadow-xl flex-col h-full bg-blue-600 border border-gray-200 shadow-2xs rounded-xl">
                <div class="p-4 md:p-6">
                    <h3 class="text-2xl font-semibold text-white">
                        Total Projects
                    </h3>
                    <p class="mt-3 text-white text-xl">
                        {{ count($projects) }}
                    </p>
                </div>
            </div>
            <div class="group flex shadow-xl flex-col h-full bg-red-600 border border-gray-200 shadow-2xs rounded-xl">
                <div class="p-4 md:p-6">
                    <h3 class="text-2xl font-semibold text-white">
                        Total Active Projects
                    </h3>
                    <p class="mt-3 text-white text-xl">
                        {{ collect($projects)->where('status', 'Active')->count() }}
                    </p>
                </div>
            </div>
            <div
                class="group flex shadow-xl flex-col h-full bg-yellow-600 border border-gray-200 shadow-2xs rounded-xl">
                <div class="p-4 md:p-6">
                    <h3 class="text-2xl font-semibold text-white">
                        Total Completed Projects
                    </h3>
                    <p class="mt-3 text-white text-xl">
                        {{ collect($projects)->where('status', 'Completed')->count() }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-6">
            @if ($latestprojects !== null)
                <div class="group flex shadow-xl flex-col h-full border border-gray-200 shadow-2xs rounded-xl">
                    <div class="p-4 md:p-6 flex justify-between">
                        <h3 class="text-2xl font-semibold text-black">
                            Recent projects by category
                        </h3>
                    </div>
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        #</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Category</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Name</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($latestprojects as $index => $category)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ $category->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ $category->latestProject->name ?? 'No Projects Found' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            @if ($largestprojects !== null)
                <div class="group flex shadow-xl flex-col h-full border border-gray-200 shadow-2xs rounded-xl">
                    <div class="p-4 md:p-6 flex justify-between">
                        <h3 class="text-2xl font-semibold text-black">
                            Large budget projects by category
                        </h3>
                    </div>
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        #</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Category</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Name</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Budget</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($largestprojects as $index => $project)
                                    @if ($project->largestproject)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                                {{ $index + 1 }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                {{ $project->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                {{ $project->largestproject->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                {{ $project->largestproject->budget }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="px-4 py-10 sm:px-6 lg:px-8 mx-auto">
        <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-6">
            @if ($latesttask !== null)

                <div class="group flex shadow-xl flex-col h-full border border-gray-200 shadow-2xs rounded-xl">
                    <div class="p-4 md:p-6 flex justify-between">
                        <h3 class="text-2xl font-semibold text-black">
                            Latest task by project
                        </h3>
                    </div>
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        #</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Project</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Task</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($latesttask as $index => $task)
                                    @if ($task->latesttask)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                                {{ $index + 1 }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                {{ $task->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                {{ $task->latesttask->task ?? 'No tasks Found' }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            @if ($taskbycategory !== null)
                <div class="group flex shadow-xl flex-col h-full border border-gray-200 shadow-2xs rounded-xl">
                    <div class="p-4 md:p-6 flex justify-between">
                        <h3 class="text-2xl font-semibold text-black">
                            Latest task by category
                        </h3>
                    </div>
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        #</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Project</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Task</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($taskbycategory as $index => $task)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ $task->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ $task->getTask->task ?? 'No tasks Found' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-pannel-layout>
