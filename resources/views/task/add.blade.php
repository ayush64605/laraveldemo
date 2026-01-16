@section('title', 'Task Form')

<x-app-layout>

    <section class="flex justify-center gap-4 mt-5">
        <div class="border-2 border-stone-200 rounded-lg p-10 shadow-xl">

            <form class="w-[500px]" action="{{ route('project.task.save') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="project_id" value="{{ $project }}">

                <h2 class="text-lg font-semibold text-gray-900">
                    Add Task
                </h2>

                @if (session('error'))
                    <x-alert type="error" :message="session('error')" />
                @endif
                @if (session('success'))
                    <x-alert type="success" :message="session('success')" />
                @endif
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-4">

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Task<span class="text-red-600">*</span>
                        </label>
                        <input type="text" name="task" value="{{ old('name') }}" placeholder="Enter Task name"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                        @error('task')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Tags</label>
                        @php
                            $tags = App\Models\Tag::all();
                        @endphp
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

                <div class="mt-8 flex justify-end gap-4">
                    <a href="{{ route('index') }}"> <x-button type="button" color="bg-red-600" text="Cancel"
                            icon="cancel" />
                    </a>
                    </a>
                    <x-button type="submit" color="bg-indigo-600" text="Save Task" icon="save" /> </a>
                </div>
            </form>
        </div>
    </section>

</x-app-layout>
