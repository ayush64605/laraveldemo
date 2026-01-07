@include('masterlayout.header')

<section class="flex justify-center gap-4 mt-5">
    <div class="border-2 border-solid rounded-lg border-blue-600 p-15 mt-4 shadow-xl">
        <form class="w-200" action="{{ route('project.save') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-4">
                    <h2 class="text-lg/10 font-semibold text-gray-900">
                        {{ isset($project) ? 'Edit Project' : 'Add Project' }}</h2>
                    <p class="mt-1 text-sm/6 text-gray-600">Please Enter Project Details.</p>
                    <input type="hidden" name="id" value="{{ $project['id'] ?? count(session('projects') ?? []) + 1 }}">

                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="mt-4 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="name" class="block text-sm/6 font-medium text-gray-900">Name</label>
                                <div class="mt-2">
                                    <div
                                        class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                        <input id="text" type="text" name="name"
                                            placeholder="Enter Project Name" value="{{ $project['name'] ?? '' }}"
                                            class="block min-w-0 grow bg-white py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                                    </div>
                                    @error('name')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="status" class="block text-sm/6 font-medium text-gray-900">Status</label>
                                <div class="mt-2">
                                    <div
                                        class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                        <select id="text" type="text" name="status"
                                            class="block min-w-0 grow bg-white py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6">
                                            <option value="">Select Status</option>
                                            <option value="Active"
                                                {{ isset($project) && $project['status'] == 'Active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="Completed"
                                                {{ isset($project) && $project['status'] == 'Completed' ? 'selected' : '' }}>
                                                Completed</option>
                                        </select>
                                    </div>
                                    @error('status')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="image" class="block text-sm/6 font-medium text-gray-900">Image</label>
                                <div class="mt-2">
                                    <div
                                        class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                        <input id="image" type="file" name="image"
                                            class="block min-w-0 grow bg-white py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                                    </div>
                                    @error('image')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="client" class="block text-sm/6 font-medium text-gray-900">Client
                                    Name</label>
                                <div class="mt-2">
                                    <div
                                        class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                        <input id="text" type="text" name="client"
                                            placeholder="Enter Client Name" value="{{ $project['client'] ?? '' }}"
                                            class="block min-w-0 grow bg-white py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                                    </div>
                                    @error('client')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="email" class="block text-sm/6 font-medium text-gray-900">Client
                                    Email</label>
                                <div class="mt-2">
                                    <div
                                        class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                        <input id="email" type="text" name="email"
                                            placeholder="Enter Client Email" value="{{ $project['email'] ?? '' }}"
                                            class="block min-w-0 grow bg-white py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                                    </div>
                                    @error('email')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="mt-4 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="start_date" class="block text-sm/6 font-medium text-gray-900">Start
                                    Date</label>
                                <div class="mt-2">
                                    <div
                                        class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                        <input id="text" type="date" name="start_date"
                                            value="{{ $project['started_at'] ?? '' }}"
                                            class="block min-w-0 grow bg-white py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                                    </div>
                                    @error('start_date')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="complete_date" class="block text-sm/6 font-medium text-gray-900">Completed
                                    Date</label>
                                <div class="mt-2">
                                    <div
                                        class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                        <input id="text" type="date" name="complete_date"
                                            value="{{ $project['completed_at'] ?? '' }}"
                                            class="block min-w-0 grow bg-white py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                                    </div>
                                    @error('complete_date')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @if (session('error'))
                            <div class="p-4 mt-4 text-sm border-b border-red-600 text-red-600 rounded-lg bg-red-100"
                                role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a href="{{ route('project.show') }}"><button type="button"
                        class="text-sm/6 font-semibold text-gray-900">Cancel</button></a>
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
        </form>
</section>
@include('masterlayout.footer')
