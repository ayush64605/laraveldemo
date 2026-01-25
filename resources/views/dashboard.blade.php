<x-pannel-layout>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-8">

        {{-- ====== STATS CARDS ====== --}}
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <div class="bg-blue-600 rounded-xl p-6 text-white shadow-sm">
                <h3 class="text-lg font-semibold">Total Projects</h3>
                <p class="mt-2 text-3xl font-bold">{{ count($projects) }}</p>
            </div>

            <div class="bg-red-600 rounded-xl p-6 text-white shadow-sm">
                <h3 class="text-lg font-semibold">Active Projects</h3>
                <p class="mt-2 text-3xl font-bold">
                    {{ collect($projects)->where('status', 'Active')->count() }}
                </p>
            </div>

            <div class="bg-yellow-500 rounded-xl p-6 text-white shadow-sm">
                <h3 class="text-lg font-semibold">Completed Projects</h3>
                <p class="mt-2 text-3xl font-bold">
                    {{ collect($projects)->where('status', 'Completed')->count() }}
                </p>
            </div>
        </div>

        {{-- ====== PROJECT TABLES ====== --}}
        <div class="grid gap-6 lg:grid-cols-2">

            {{-- Recent Projects --}}
            @if ($latestprojects)
            <div class="bg-white rounded-xl border shadow-sm">
                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold">Recent Projects by Category</h3>
                </div>

                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left font-medium text-gray-500">#</th>
                                <th class="px-4 py-2 text-left font-medium text-gray-500">Category</th>
                                <th class="px-4 py-2 text-left font-medium text-gray-500">Project</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach ($latestprojects as $i => $category)
                                <tr>
                                    <td class="px-4 py-2">{{ $i + 1 }}</td>
                                    <td class="px-4 py-2">{{ $category->name }}</td>
                                    <td class="px-4 py-2">
                                        {{ $category->latestProject->name ?? '—' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            {{-- Large Budget Projects --}}
            @if ($largestprojects)
            <div class="bg-white rounded-xl border shadow-sm">
                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold">Large Budget Projects</h3>
                </div>

                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">Category</th>
                                <th class="px-4 py-2">Project</th>
                                <th class="px-4 py-2">Budget</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach ($largestprojects as $i => $project)
                                @if ($project->largestproject)
                                <tr>
                                    <td class="px-4 py-2">{{ $i + 1 }}</td>
                                    <td class="px-4 py-2">{{ $project->name }}</td>
                                    <td class="px-4 py-2">{{ $project->largestproject->name }}</td>
                                    <td class="px-4 py-2 font-medium">
                                        ₹{{ number_format($project->largestproject->budget) }}
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

        {{-- ====== TASK TABLES ====== --}}
        <div class="grid gap-6 lg:grid-cols-2">

            {{-- Latest Task by Project --}}
            @if ($latesttask)
            <div class="bg-white rounded-xl border shadow-sm">
                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold">Latest Task by Project</h3>
                </div>

                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">Project</th>
                                <th class="px-4 py-2">Task</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach ($latesttask as $i => $task)
                                @if ($task->latesttask)
                                <tr>
                                    <td class="px-4 py-2">{{ $i + 1 }}</td>
                                    <td class="px-4 py-2">{{ $task->name }}</td>
                                    <td class="px-4 py-2">{{ $task->latesttask->task }}</td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            {{-- Latest Task by Category --}}
            @if ($taskbycategory)
            <div class="bg-white rounded-xl border shadow-sm">
                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold">Latest Task by Category</h3>
                </div>

                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">Category</th>
                                <th class="px-4 py-2">Task</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach ($taskbycategory as $i => $task)
                                <tr>
                                    <td class="px-4 py-2">{{ $i + 1 }}</td>
                                    <td class="px-4 py-2">{{ $task->name }}</td>
                                    <td class="px-4 py-2">{{ $task->getTask->task ?? '—' }}</td>
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
