@section('title', 'Projects')

<x-app-layout>
    <div
        class="max-w-[60rem] shadow-xl rounded-lg border-2 border-solid mt-10 border-stone-200 px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto ">
        <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-6">
            <div class=" flex">
                <div class="p-4 md:p-6">
                    <h3 class="text-2xl font-semibold text-black">
                        All Tag
                    </h3>
                    <p class="mt-3 text-grey text-lg">
                        Total {{ count($tags) }} Tag
                    </p>
                </div>
            </div>
            <div class="flex items-center justify-end">
                <div class="p-4 md:p-6">
                    <x-button type="button" icon="plus" color="bg-indigo-600" text="Add Tag"
                        onclick="document.getElementById('addModal').classList.remove('hidden')" />
                </div>
                <div id="addModal"
                    class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">
                    <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 text-left">
                        <form action="{{ route('tag.save') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <h2 class="text-lg font-semibold text-gray-900">
                                Add Tag
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-4">

                                <div>
                                    <label class="block text-sm font-medium text-gray-900">Tag Name <span
                                            class="text-red-600">*</span>
                                    </label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        placeholder="Enter Tag name"
                                        class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                                    @error('name')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            <div class="mt-8 flex justify-end gap-4">
                                <a href="{{ route('index') }}"> <x-button type="button" color="bg-red-600"
                                        text="Cancel" icon="cancel" />
                                </a>
                                </a>
                                <x-button type="submit" color="bg-indigo-600" text="Save Tag" icon="save" /> </a>
                            </div>
                        </form>
                    </div>
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
                                        Name</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Total Projects</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Projects Name</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($tags as $index => $tag)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            {{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            {{ $tag['name'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            {{ count($tag->projects) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            @foreach ($tag->projects as $project)
                                                {{ $project->name }},
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">

                                            <x-button type="button" color="bg-red-600" text="Delete" icon="trash"
                                                onclick="document.getElementById('deleteModal-{{ $tag['id'] }}').classList.remove('hidden')" />

                                            <div id="deleteModal-{{ $tag['id'] }}"
                                                class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">

                                                <div
                                                    class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 text-left">
                                                    <h3 class="text-lg font-semibold text-gray-900">
                                                        Delete Tag
                                                    </h3>

                                                    <p class="mt-2 text-sm text-gray-600">
                                                        Are you sure you want to delete this Tag?
                                                    </p>

                                                    <div class="mt-6 flex justify-end gap-3">
                                                        <x-button type="button" color="bg-indigo-600" text="Cancel"
                                                            icon="cancel"
                                                            onclick="document.getElementById('deleteModal-{{ $tag['id'] }}').classList.add('hidden')" />


                                                        <a href="{{ route('tag.delete', ['tag' => $tag['id']]) }}">
                                                            <x-button type="button" color="bg-red-600"
                                                                text="Yes, Delete" icon="trash" /> </a>
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
</x-app-layout>
