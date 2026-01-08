@include('masterlayout.header')

<section class="flex justify-center gap-4 mt-5">
    <div class="border-2 border-stone-200 rounded-lg p-10 shadow-xl">

        <form class="w-[1100px]" action="{{ route('project.save') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" value="{{ $project['id'] ?? count(session('projects') ?? []) + 1 }}">

            <h2 class="text-lg font-semibold text-gray-900">
                {{ isset($project) ? 'Edit Project' : 'Add Project' }}
            </h2>

            <p class="text-sm text-gray-600 mb-6">Project & Client Details</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div>
                    <label class="block text-sm font-medium text-gray-900">Project Name</label>
                    <input type="text" name="name" value="{{ $project['name'] ?? '' }}"
                        class="mt-2 block w-full rounded-md bg-white px-3 py-2 outline outline-1 outline-gray-300 focus:outline-indigo-600">
                    @error('name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900">Project Code</label>
                    <input type="text" name="project_code" value="{{ $project['project_code'] ?? '' }}"
                        class="mt-2 block w-full rounded-md bg-white px-3 py-2 outline outline-1 outline-gray-300 focus:outline-indigo-600">
                    @error('project_code')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900 mb-2">Project Status</label>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="status" value="Active"
                            {{ ($project['status'] ?? '') === 'Active' ? 'checked' : '' }} class="sr-only peer">
                        <div
                            class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-indigo-600
                            after:content-[''] after:absolute after:top-0.5 after:left-0.5
                            after:bg-white after:border after:rounded-full after:h-5 after:w-5
                            after:transition-all peer-checked:after:translate-x-full">
                        </div>
                        <span class="ml-3 text-sm text-gray-700">
                            {{ ($project['status'] ?? '') === 'Active' ? 'Active' : 'Completed' }}
                        </span>
                    </label>
                    @error('status')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900 mb-2">Featured Project</label>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1"
                            {{ $project['is_featured'] ?? false ? 'checked' : '' }} class="sr-only peer">
                        <div
                            class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-green-600
                            after:content-[''] after:absolute after:top-0.5 after:left-0.5
                            after:bg-white after:border after:rounded-full after:h-5 after:w-5
                            after:transition-all peer-checked:after:translate-x-full">
                        </div>
                    </label>
                    @error('is_featured')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900">Priority</label>
                    <div class="flex gap-4 mt-2">
                        @foreach (['Low', 'Medium', 'High'] as $p)
                            <label class="flex items-center gap-2 text-sm">
                                <input type="radio" name="priority" value="{{ $p }}"
                                    {{ ($project['priority'] ?? '') == $p ? 'checked' : '' }}>
                                {{ $p }}
                            </label>
                        @endforeach
                    </div>
                    @error('priority')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900">Progress (%)</label>
                    <input type="range" name="progress" min="0" max="100"
                        value="{{ $project['progress'] ?? 0 }}" class="mt-3 w-full accent-indigo-600">
                    @error('progress')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900">Budget</label>
                    <input type="number" name="budget" value="{{ $project['budget'] ?? '' }}"
                        class="mt-2 block w-full rounded-md bg-white px-3 py-2 outline outline-1 outline-gray-300">
                    @error('budget')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900">Project URL</label>
                    <input type="url" name="project_url" value="{{ $project['project_url'] ?? '' }}"
                        class="mt-2 block w-full rounded-md bg-white px-3 py-2 outline outline-1 outline-gray-300">
                    @error('project_url')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900">Start Date</label>
                    <input type="date" name="start_date" value="{{ $project['started_at'] ?? '' }}"
                        class="mt-2 block w-full rounded-md bg-white px-3 py-2 outline outline-1 outline-gray-300">
                    @error('start_date')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900">End Date</label>
                    <input type="date" name="complete_date" value="{{ $project['completed_at'] ?? '' }}"
                        class="mt-2 block w-full rounded-md bg-white px-3 py-2 outline outline-1 outline-gray-300">
                    @error('complete_date')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900">Deadline Time</label>
                    <input type="time" name="deadline_time" value="{{ $project['deadline_time'] ?? '' }}"
                        class="mt-2 block w-full rounded-md bg-white px-3 py-2 outline outline-1 outline-gray-300">
                    @error('deadline_time')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900">Project Type</label>
                    <select name="project_type"
                        class="mt-2 block w-full rounded-md bg-white px-3 py-2 outline outline-1 outline-gray-300">
                        <option value="">Select</option>
                        <option value="Internal"
                            {{ ($project['project_type'] ?? '') == 'Internal' ? 'selected' : '' }}>Internal</option>
                        <option value="Client" {{ ($project['project_type'] ?? '') == 'Client' ? 'selected' : '' }}>
                            Client</option>
                    </select>
                    @error('project_type')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900">Technologies</label>
                    @php
                        $techs = ['Laravel', 'React', 'Vue', 'Node'];
                        $sel = $project['technologies'] ?? [];
                    @endphp
                    <div class="grid grid-cols-2 gap-2 mt-2">
                        @foreach ($techs as $t)
                            <label class="flex items-center gap-2 text-sm">
                                <input type="checkbox" name="technologies[]" value="{{ $t }}"
                                    {{ in_array($t, $sel) ? 'checked' : '' }}>
                                {{ $t }}
                            </label>
                        @endforeach
                    </div>
                    @error('technologies')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="md:col-span-3">
                    <label class="block text-sm font-medium text-gray-900">Description</label>
                    <textarea name="description" rows="3"
                        class="mt-2 block w-full rounded-md bg-white px-3 py-2 outline outline-1 outline-gray-300">{{ $project['description'] ?? '' }}</textarea>
                    @error('description')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Image --}}
                <div>
                    <label class="block text-sm font-medium text-gray-900">Project Image</label>
                    <input type="file" name="image" class="mt-2 block w-full text-sm">
                    @error('image')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Client Details --}}
                <div class="md:col-span-3 border-t pt-6 mt-6">
                    <h3 class="text-md font-semibold text-gray-900 mb-4">Client Details</h3>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900">Client Name</label>
                    <input type="text" name="client_name" value="{{ $project['client_name'] ?? '' }}"
                        class="mt-2 block w-full rounded-md bg-white px-3 py-2 outline outline-1 outline-gray-300">
                    @error('client_name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900">Client Email</label>
                    <input type="text" name="client_email" value="{{ $project['client_email'] ?? '' }}"
                        class="mt-2 block w-full rounded-md bg-white px-3 py-2 outline outline-1 outline-gray-300">
                    @error('client_email')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900">Client Phone</label>
                    <input type="tel" name="client_phone" value="{{ $project['client_phone'] ?? '' }}"
                        class="mt-2 block w-full rounded-md bg-white px-3 py-2 outline outline-1 outline-gray-300">
                    @error('client_phone')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900">Company</label>
                    <input type="text" name="client_company" value="{{ $project['client_company'] ?? '' }}"
                        class="mt-2 block w-full rounded-md bg-white px-3 py-2 outline outline-1 outline-gray-300">
                    @error('client_company')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900">Client Pan No.</label>
                    <input type="text" name="client_pan" value="{{ $project['client_pan'] ?? '' }}"
                        class="mt-2 block w-full rounded-md bg-white px-3 py-2 outline outline-1 outline-gray-300">
                    @error('client_pan')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900">Website</label>
                    <input type="text" name="client_website" value="{{ $project['client_website'] ?? '' }}"
                        class="mt-2 block w-full rounded-md bg-white px-3 py-2 outline outline-1 outline-gray-300">
                    @error('client_website')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-900">Address</label>
                    <textarea name="client_address" rows="2"
                        class="mt-2 block w-full rounded-md bg-white px-3 py-2 outline outline-1 outline-gray-300">{{ $project['client_address'] ?? '' }}</textarea>
                    @error('client_address')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="mt-8 flex justify-end gap-4">
                <a href="{{ route('project.show') }}"> <x-button
                        type="button" color="red" text="Cancel" /> </a>
                </a>
                <x-button type="submit" color="indigo" text="Save Project" /> </a>
            </div>

        </form>
    </div>
</section>

@include('masterlayout.footer')
