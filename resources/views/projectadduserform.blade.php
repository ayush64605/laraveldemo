@section('title', 'Add user')

@include('masterlayout.header')

<section class="flex justify-center gap-4 mt-5">
    <div class="border-2 border-stone-200 rounded-lg p-10 shadow-xl">

        <form class="w-[500px]" action="{{ route('project.user.save', ['project' => $project->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <h2 class="text-lg font-semibold text-gray-900">
                Add user in {{ $project->name }}
            </h2>

            @if (session('error'))
                <x-alert type="error" :message="session('error')" />
            @endif
            @if (session('success'))
                <x-alert type="success" :message="session('success')" />
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">

                <div>
                    <label class="block text-sm font-medium text-gray-900">User Name <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="name" placeholder="Enter User name"
                        class="mt-2 block w-full rounded-md bg-white px-3 py-2 outline outline-1 outline-gray-300 focus:outline-indigo-600">
                    @error('name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-900">User Email<span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="email" placeholder="Enter User Email"
                        class="mt-2 block w-full rounded-md bg-white px-3 py-2 outline outline-1 outline-gray-300 focus:outline-indigo-600">
                    @error('email')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="mt-8 flex justify-end gap-4">
                <a href="{{ route('project.show') }}"> <x-button type="button" color="red" text="Cancel"
                        icon="cancel" />
                </a>
                </a>
                <x-button type="submit" color="indigo" text="Save" icon="save" /> </a>
            </div>
        </form>
    </div>
</section>

@include('masterlayout.footer')
