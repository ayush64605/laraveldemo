@section('title', 'Assign Project')

<x-app-layout>

    <section class="flex justify-center gap-4 mt-5">
        <div class="border-2 border-stone-200 rounded-lg p-10 shadow-xl">

            <form class="w-[500px]" action="{{ route('employee-project.save', ['employee' => $employee]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <h2 class="text-lg font-semibold text-gray-900">
                    Assign Project
                </h2>

                @if (session('error'))
                    <x-alert type="error" :message="session('error')" />
                @endif
                @if (session('success'))
                    <x-alert type="success" :message="session('success')" />
                @endif
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-4">

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Project<span
                                class="text-red-600">*</span>
                        </label>
                        <select name="project"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">Select Project</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                        @error('project')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-4">
                    <a href="{{ route('employee-project.show', ['employee' => $employee]) }}"> <x-button type="button"
                            color="bg-red-600" text="Cancel" icon="cancel" />
                    </a>
                    </a>
                    <x-button type="submit" color="bg-indigo-600" text="Save" icon="save" /> </a>
                </div>
            </form>
        </div>
    </section>

</x-app-layout>
