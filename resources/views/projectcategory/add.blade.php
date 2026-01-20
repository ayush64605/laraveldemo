@section('title', 'Project Category Form')

<x-pannel-layout>

    <section>
        <div>

            <form action="{{ route('projectcategory.save') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $projectcategory['id'] ?? $last_projectcategory->id + 1 }}">

                <h2 class="text-lg font-semibold text-gray-900">
                    {{ isset($projectcategory) ? 'Edit Project Category' : 'Add Project Category' }}
                </h2>

                <p class="text-sm text-gray-600 mb-6">Project Category</p>

                @if (session('error'))
                    <x-alert type="error" :message="session('error')" />
                @endif
                @if (session('success'))
                    <x-alert type="success" :message="session('success')" />
                @endif
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-4">

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Project Category Name <span
                                class="text-red-600">*</span>
                        </label>
                        <input type="text" name="name" value="{{ $projectcategory['name'] ?? old('name') }}"
                            placeholder="Enter project category name"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                        @error('name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="mt-8 flex justify-end gap-4">
                    <a href="{{ route('projectcategory.show') }}"> <x-button type="button" color="bg-red-600"
                            text="Cancel" icon="cancel" />
                    </a>
                    </a>
                    <x-button type="submit" color="bg-indigo-600" text="Save Project Category" icon="save" /> </a>
                </div>
            </form>
        </div>
    </section>

</x-pannel-layout>
