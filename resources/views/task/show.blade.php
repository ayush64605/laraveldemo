<x-pannel-layout>
    <x-card>
        <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-6">
            <div class="flex">
                <div class="p-4">
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
                                class="rounded-md bg-white px-3 py-2 border border-gray-300 text-sm w-36"
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
                        <x-button type="button" icon="plus" color="bg-indigo-600" text="Add Task"
                            onclick="document.getElementById('addModal').classList.remove('hidden')" />
                    </div>

                    <x-form-modal id="addModal" title="Add Task" action="{{ route('project.task.save') }}"
                        enctype="multipart/form-data">
                        <input type="hidden" name="project_id" value="{{ $project }}">
                        <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-900">Task<span
                                        class="text-red-600">*</span></label>
                                <input type="text" name="task" value="{{ old('task') }}"
                                    placeholder="Enter Task name"
                                    class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @error('task')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-900">Tags</label>
                                <div class="grid grid-cols-2 gap-2 mt-2">
                                    @foreach ($tags as $t)
                                        <label class="flex items-center gap-2 text-sm">
                                            <input type="checkbox" name="tags[]" value="{{ $t->id }}">
                                            {{ $t->name }}
                                        </label>
                                    @endforeach
                                </div>
                                @error('tags')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </x-form-modal>
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
                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <x-table.th>#</x-table.th>
                                    <x-table.th>Task</x-table.th>
                                    <x-table.th class="text-end">Action</x-table.th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($tasks as $index => $task)
                                    <tr class="hover:bg-gray-50 transition">
                                        <x-table.td>{{ $index + 1 }}</x-table.td>
                                        <x-table.td>{{ $task->task }}</x-table.td>
                                        <x-table.td class="text-end">
                                            @if (Auth::user())
                                                <x-button type="button" icon="eye" color="bg-indigo-600"
                                                    text="View Comments"
                                                    onclick="document.getElementById('commentModal-{{ $task->id }}').classList.remove('hidden')" />
                                                <x-button type="button" color="bg-red-600" text="Delete"
                                                    icon="trash"
                                                    onclick="document.getElementById('deleteModal-{{ $task->id }}').classList.remove('hidden')" />
                                            @endif
                                            @if (session('employeedata'))
                                                <x-button type="button" icon="plus" color="bg-indigo-600"
                                                    text="Add Comments"
                                                    onclick="document.getElementById('addComment-{{ $task->id }}').classList.remove('hidden')" />
                                            @endif

                                            <x-form-modal id="addComment-{{ $task->id }}" title="Add Comment"
                                                action="{{ route('comment.save') }}">
                                                <input type="hidden" name="task" value="{{ $task->id }}">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-900">Comment<span
                                                            class="text-red-600">*</span></label>
                                                    <input type="text" name="comment" placeholder="Enter comment"
                                                        class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                    @error('comment')
                                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </x-form-modal>

                                            <x-genral-modal id="deleteModal-{{ $task->id }}" title="Delete Task"
                                                description="Are you sure you want to delete this task?">
                                                <div class="mt-6 flex justify-end gap-3">
                                                    <x-button type="button" color="bg-indigo-600" text="Cancel"
                                                        icon="cancel"
                                                        onclick="document.getElementById('deleteModal-{{ $task->id }}').classList.add('hidden')" />
                                                    <a
                                                        href="{{ route('project.task.delete', ['task' => $task->id]) }}">
                                                        <x-button type="button" color="bg-red-600" text="Yes, Delete"
                                                            icon="trash" />
                                                    </a>
                                                </div>
                                            </x-genral-modal>

                                            <x-genral-modal id="commentModal-{{ $task->id }}" title="All Comments">
                                                <div class="mt-2 text-sm text-gray-600">
                                                    @foreach ($task->comments as $comment)
                                                        <ul>
                                                            <li>{{ $comment->body }}</li>
                                                        </ul>
                                                    @endforeach
                                                </div>
                                                <div class="mt-6 flex justify-end gap-3">
                                                    <x-button type="button" color="bg-indigo-600" text="Cancel"
                                                        icon="cancel"
                                                        onclick="document.getElementById('commentModal-{{ $task->id }}').classList.add('hidden')" />
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
