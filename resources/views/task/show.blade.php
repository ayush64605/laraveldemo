@section('title', 'Tasks')

<x-pannel-layout>
    <div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-6">
            <div class=" flex">
                <div class="p-4 md:p-6">
                    <h3 class="text-2xl font-semibold text-black">
                        All Tasks
                    </h3>
                    <p class="mt-3 text-grey text-lg">
                        Total {{ count($tasks) }} Tasks
                    </p>
                </div>
            </div>
            @if (Auth::user())
                <div class="flex items-center justify-end">
                    <form action="{{ route('project.task.show', ['project' => $project]) }}" method="GET"
                        id="filterForm">
                        <div>
                            @php
                                $tags = App\Models\Tag::all();
                            @endphp
                            <select name="tag_id" onchange="document.getElementById('filterForm').submit()"
                                class="block w-full rounded-md bg-white px-3 py-2 outline outline-1 outline-gray-300"
                                style="width: 120px;">
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

                    <div class="p-4 md:p-6">
                        <a href="{{ route('project.task.add', ['project' => $project]) }}"
                            class="text-sm/6 font-semibold text-white"><x-button type="button" icon="plus"
                                color="bg-indigo-600" text="Add Tasks" /></a>
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
                                        Task</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($tasks as $index => $task)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            {{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            {{ $task['task'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                            @if (Auth::user())
                                                <x-button type="button" icon="eye" color="bg-indigo-600"
                                                    text="View Comments"
                                                    onclick="document.getElementById('commentModal-{{ $task->id }}').classList.remove('hidden')" />
                                                <x-button type="button" color="bg-red-600" text="Delete"
                                                    icon="trash"
                                                    onclick="document.getElementById('deleteModal-{{ $task['id'] }}').classList.remove('hidden')" />
                                            @endif
                                            @if (session('employeedata'))
                                                <a href="{{ route('comment.task.add', ['post' => $task->id]) }}"
                                                    class="text-sm/6 font-semibold text-white"><x-button type="button"
                                                        icon="plus" color="bg-indigo-600" text="Add Comments" /></a>
                                            @endif
                                            <div id="deleteModal-{{ $task['id'] }}"
                                                class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">

                                                <div
                                                    class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 text-left">
                                                    <h3 class="text-lg font-semibold text-gray-900">
                                                        Delete Task?
                                                    </h3>

                                                    <p class="mt-2 text-sm text-gray-600">
                                                        Are you sure you want to delete this task?
                                                    </p>

                                                    <div class="mt-6 flex justify-end gap-3">
                                                        <x-button type="button" color="bg-indigo-600" text="Cancel"
                                                            icon="cancel"
                                                            onclick="document.getElementById('deleteModal-{{ $task['id'] }}').classList.add('hidden')" />


                                                        <a
                                                            href="{{ route('project.task.delete', ['task' => $task['id']]) }}">
                                                            <x-button type="button" color="bg-red-600"
                                                                text="Yes, Delete" icon="trash" /> </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="commentModal-{{ $task['id'] }}"
                                                class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">

                                                <div
                                                    class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 text-left">
                                                    <h3 class="text-lg font-semibold text-gray-900">
                                                        All Comments
                                                    </h3>

                                                    <p class="mt-2 text-sm text-gray-600">
                                                        @foreach ($task->comments as $comment)
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
                                                            onclick="document.getElementById('commentModal-{{ $task['id'] }}').classList.add('hidden')" />
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
</x-pannel-layout>
