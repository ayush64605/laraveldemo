@section('title', 'Project Form')

<x-app-layout>

    <section class="flex justify-center gap-4 mt-5">
        <div class="border-2 border-stone-200 rounded-lg p-10 shadow-xl">

            <form class="w-[1100px]" action="{{ route('project.save') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $project['id'] ?? $last_project->id + 1 }}">

                <h2 class="text-lg font-semibold text-gray-900">
                    {{ isset($project) ? 'Edit Project' : 'Add Project' }}
                </h2>

                <p class="text-sm text-gray-600 mb-6">Project & Client Details</p>

                @if (session('error'))
                    <x-alert type="error" :message="session('error')" />
                @endif
                @if (session('success'))
                    <x-alert type="success" :message="session('success')" />
                @endif
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Project Category</label>
                        <select name="project_category"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">Select</option>
                            @foreach ($projectcategories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == ($project['project_category'] ?? '') ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('project_category')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Project Name <span
                                class="text-red-600">*</span>
                        </label>
                        <input type="text" name="name" value="{{ $project['name'] ?? old('name') }}"
                            placeholder="Enter project Name"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                        @error('name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Project Code <span
                                class="text-red-600">*</span></label>
                        <input type="text" name="project_code"
                            value="{{ $project['project_code'] ?? old('project_code') }}"
                            placeholder="Enter Project Code (ex. cbt-000)"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                        @error('project_code')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Project Key <span
                                class="text-red-600 {{ $project['id'] ?? null ? 'hidden' : '' }}">*</span></label>
                        <input type="text" name="project_key"
                            placeholder="{{ $project['id'] ?? null ? '*****' : 'Enter Project Key' }}"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                        @error('project_key')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Confirm Project Key <span
                                class="text-red-600 {{ $project['id'] ?? null ? 'hidden' : '' }}">*</span></label>
                        <input type="text" name="c_project_key"
                            placeholder="{{ $project['id'] ?? null ? '*****' : 'Enter Confirm Project Key' }}"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                        @error('project_key')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900 mb-2">Project Status</label>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <span class="ml-3 text-sm text-gray-700">Active</span> &nbsp;&nbsp;
                            <input type="checkbox" name="status" value="Completed"
                                {{ (old('status') ?? ($project['status'] ?? '')) === 'Completed' ? 'checked' : '' }}
                                class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-indigo-600
                            after:content-[''] after:absolute after:top-0.5 after:left-15.5
                            after:bg-white after:border after:rounded-full after:h-5 after:w-5
                            after:transition-all peer-checked:after:translate-x-full">
                            </div>
                            <span class="ml-3 text-sm text-gray-700">
                                Completed
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
                                {{ old('is_featured') ?? ($project['is_featured'] ?? false) ? 'checked' : '' }}
                                class="sr-only peer">
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
                        <label class="block text-sm font-medium text-gray-900">Priority <span
                                class="text-red-600">*</span></label>
                        <div class="flex gap-4 mt-2">
                            @foreach (['Low', 'Medium', 'High'] as $p)
                                <label class="flex items-center gap-2 text-sm">
                                    <input type="radio" name="priority" value="{{ $p }}"
                                        {{ (old('priority') ?? ($project['priority'] ?? '')) == $p ? 'checked' : '' }}>
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
                            value="{{ $project['progress'] ?? old('progress') }}"
                            class="mt-3 w-full accent-indigo-600">
                        @error('progress')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Budget</label>
                        <input type="text" name="budget" value="{{ $project['budget'] ?? old('budget') }}"
                            placeholder="Enter Budget"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @error('budget')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Project URL</label>
                        <input type="url" name="project_url"
                            value="{{ $project['project_url'] ?? old('project_url') }}" placeholder="Enter Project URl"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @error('project_url')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Start Date <span
                                class="text-red-600">*</span></label>
                        <input type="date" name="start_date"
                            value="{{ $project['started_at'] ?? null ? $project['started_at']->format('Y-m-d') : '' }}"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @error('start_date')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">End Date <span
                                class="text-red-600">*</span></label>
                        <input type="date" name="complete_date"
                            value="{{ $project['started_at'] ?? null ? $project['started_at']->format('Y-m-d') : '' }}"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @error('complete_date')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Deadline Time</label>
                        <input type="time" name="deadline_time"
                            value="{{ $project['deadline_time'] ?? old('deadline_time') }}"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @error('deadline_time')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Project Type</label>
                        <select name="project_type"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">Select</option>
                            <option value="Internal"
                                {{ (old('priority') ?? ($project['project_type'] ?? '')) == 'Internal' ? 'selected' : '' }}>
                                Internal</option>
                            <option value="Client"
                                {{ (old('priority') ?? ($project['project_type'] ?? '')) == 'Client' ? 'selected' : '' }}>
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
                            if (isset($project)) {
                                $sel = $project->technologies;
                            } else {
                                $sel = [];
                            }
                        @endphp
                        <div class="grid grid-cols-2 gap-2 mt-2">
                            @foreach ($techs as $t)
                                <label class="flex items-center gap-2 text-sm">
                                    <input type="checkbox" name="technologies[]" value="{{ $t }}"
                                        @checked(in_array($t, old('technologies', $sel)))> {{ $t }}
                                </label>
                            @endforeach
                        </div>
                        @error('technologies')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Tags</label>
                        @php
                            $tags = App\Models\Tag::all();
                            if (isset($project)) {
                                $sel = $project->tags->pluck('id')->toArray();
                            } else {
                                $sel = [];
                            }
                        @endphp
                        <div class="grid grid-cols-2 gap-2 mt-2">
                            @foreach ($tags as $t)
                                <label class="flex items-center gap-2 text-sm">
                                    <input type="checkbox" name="tags[]" value="{{ $t->id }}"
                                        @checked(in_array($t->id, old('tags', $sel)))> {{ $t->name }}
                                </label>
                            @endforeach
                        </div>
                        @error('tags')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>



                    <div class="md:col-span-3">
                        <label class="block text-sm font-medium text-gray-900">Description</label>
                        <textarea name="description" rows="3" placeholder="Enter Description"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ $project['description'] ?? old('description') }}</textarea>
                        @error('description')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Project Image <span
                                class="text-red-600">*</span></label>
                        <input type="file" name="image"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @error('image')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-3 border-t pt-6 mt-6">
                        <h3 class="text-md font-semibold text-gray-900 mb-4">Client Details</h3>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Client Name <span
                                class="text-red-600">*</span></label>
                        <input type="text" name="client_name"
                            value="{{ $project['client_name'] ?? old('client_name') }}"
                            placeholder="Enter Client Name"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @error('client_name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Client Email <span
                                class="text-red-600">*</span></label>
                        <input type="text" name="client_email"
                            value="{{ $project['client_email'] ?? old('client_email') }}"
                            placeholder="Enter Client Email"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @error('client_email')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Client Phone</label>
                        <input type="tel" name="client_phone"
                            value="{{ $project['client_phone'] ?? old('clinet_phone') }}"
                            placeholder="Enter Client Phone No."
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @error('client_phone')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Company</label>
                        <input type="text" name="client_company"
                            value="{{ $project['client_company'] ?? old('client_company') }}"
                            placeholder="Enter Company"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @error('client_company')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Client Pan No. <span
                                class="text-red-600">*</span></label>
                        <input type="text" name="client_pan"
                            value="{{ $project['client_pan'] ?? old('client_pan') }}"
                            placeholder="Enter Pan No.(Ex. AAAAA1234A)"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @error('client_pan')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Website</label>
                        <input type="text" name="client_website"
                            value="{{ $project['client_website'] ?? old('client_website') }}"
                            placeholder="Enter Company's Website"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @error('client_website')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-900">Address</label>
                        <textarea name="client_address" rows="2" placeholder="Enter Address"
                            class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ $project['client_address'] ?? old('client_address') }}</textarea>
                        @error('client_address')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="mt-8 flex justify-end gap-4">
                    <a href="{{ route('project.show') }}"> <x-button type="button" color="bg-red-600"
                            text="Cancel" icon="cancel" />
                    </a>
                    </a>
                    <x-button type="submit" color="bg-indigo-600" text="Save Project" icon="save" /> </a>
                </div>

            </form>
        </div>
    </section>

</x-app-layout>
