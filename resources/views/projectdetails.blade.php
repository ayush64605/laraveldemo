@section('title','Project Details')
@include('masterlayout.header')

<div
    class="max-w-[60rem] shadow-xl border-2 border-solid rounded-lg border-stone-200 mt-10 px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">

    <div class="grid sm:grid-cols-2 gap-6 mb-6">
        <div class="p-4 md:p-6">
            <h3 class="text-2xl font-semibold text-black">
                Project Details
            </h3>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <tbody class="divide-y divide-gray-200">

                {{-- BASIC INFO --}}
                <tr>
                    <td class="px-6 py-4 font-medium"><b>Project Name :</b></td>
                    <td class="px-6 py-4">{{ $project['name'] }}</td>
                </tr>

                <tr>
                    <td class="px-6 py-4 font-medium"><b>Project Code :</b></td>
                    <td class="px-6 py-4">{{ $project['project_code'] ?? '-' }}</td>
                </tr>

                <tr>
                    <td class="px-6 py-4 font-medium"><b>Project Key :</b></td>
                    <td class="px-6 py-4">{{ $project['project_key'] ?? '-' }}</td>
                </tr>

                <tr>
                    <td class="px-6 py-4 font-medium"><b>Status :</b></td>
                    <td class="px-6 py-4">
                        <span
                            class="px-3 py-1 rounded-full text-sm font-semibold
                        {{ $project['status'] === 'Active' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-700' }}">
                            {{ $project['status'] }}
                        </span>
                    </td>
                </tr>

                <tr>
                    <td class="px-6 py-4 font-medium"><b>Featured :</b></td>
                    <td class="px-6 py-4">
                        {{ $project['is_featured'] ?? false ? 'Yes' : 'No' }}
                    </td>
                </tr>

                {{-- PROJECT SETTINGS --}}
                <tr>
                    <td class="px-6 py-4 font-medium"><b>Priority :</b></td>
                    <td class="px-6 py-4">{{ $project['priority'] ?? '-' }}</td>
                </tr>

                <tr>
                    <td class="px-6 py-4 font-medium"><b>Progress :</b></td>
                    <td class="px-6 py-4">{{ $project['progress'] ?? 0 }}%</td>
                </tr>

                <tr>
                    <td class="px-6 py-4 font-medium"><b>Budget :</b></td>
                    <td class="px-6 py-4">₹ {{ number_format($project['budget'] ?? 0) }}</td>
                </tr>

                <tr>
                    <td class="px-6 py-4 font-medium"><b>Project URL :</b></td>
                    <td class="px-6 py-4">
                        @if (!empty($project['project_url']))
                            <a href="{{ $project['project_url'] }}" target="_blank"
                                class="text-indigo-600 hover:underline">
                                {{ $project['project_url'] }}
                            </a>
                        @else
                            -
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class="px-6 py-4 font-medium"><b>Project Type :</b></td>
                    <td class="px-6 py-4">{{ $project['project_type'] ?? '-' }}</td>
                </tr>

                {{-- DATES --}}
                <tr>
                    <td class="px-6 py-4 font-medium"><b>Start Date :</b></td>
                    <td class="px-6 py-4">{{ $project['started_at'] }}</td>
                </tr>

                <tr>
                    <td class="px-6 py-4 font-medium"><b>Completed Date :</b></td>
                    <td class="px-6 py-4">{{ $project['completed_at'] }}</td>
                </tr>

                <tr>
                    <td class="px-6 py-4 font-medium"><b>Deadline Time :</b></td>
                    <td class="px-6 py-4">{{ $project['deadline_time'] ?? '-' }}</td>
                </tr>

                {{-- TECHNOLOGIES --}}
                <tr>
                    <td class="px-6 py-4 font-medium"><b>Technologies :</b></td>
                    <td class="px-6 py-4">
                        @if (!empty($project['technologies']))
                            <div class="flex gap-2 flex-wrap">
                                @foreach (json_decode($project['technologies']) as $tech)
                                    <span class="px-3 py-1 text-sm rounded-full bg-indigo-100 text-indigo-700">
                                        {{ $tech }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            -
                        @endif
                    </td>
                </tr>

                {{-- DESCRIPTION --}}
                <tr>
                    <td class="px-6 py-4 font-medium"><b>Description :</b></td>
                    <td class="px-6 py-4">{{ $project['description'] ?? '-' }}</td>
                </tr>

                {{-- IMAGE --}}
                <tr>
                    <td class="px-6 py-4 font-medium"><b>Project Image :</b></td>
                    <td class="px-6 py-4">
                        <img src="{{ asset('storage/' . $project['image']) }}" class="h-28 rounded-lg shadow">
                    </td>
                </tr>

                {{-- CLIENT DETAILS --}}
                <tr class="bg-gray-50">
                    <td colspan="2" class="px-6 py-4 font-semibold text-gray-900">
                        Client Details
                    </td>
                </tr>

                <tr>
                    <td class="px-6 py-4 font-medium"><b>Client Name :</b></td>
                    <td class="px-6 py-4">{{ $project['client_name'] }}</td>
                </tr>

                <tr>
                    <td class="px-6 py-4 font-medium"><b>Client Email :</b></td>
                    <td class="px-6 py-4">{{ $project['client_email'] }}</td>
                </tr>

                <tr>
                    <td class="px-6 py-4 font-medium"><b>Client Phone :</b></td>
                    <td class="px-6 py-4">{{ $project['client_phone'] ?? '-' }}</td>
                </tr>

                <tr>
                    <td class="px-6 py-4 font-medium"><b>Company :</b></td>
                    <td class="px-6 py-4">{{ $project['client_company'] ?? '-' }}</td>
                </tr>

                <tr>
                    <td class="px-6 py-4 font-medium"><b>Website :</b></td>
                    <td class="px-6 py-4">
                        @if (!empty($project['client_website']))
                            <a href="{{ $project['client_website'] }}" target="_blank"
                                class="text-indigo-600 hover:underline">
                                {{ $project['client_website'] }}
                            </a>
                        @else
                            -
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class="px-6 py-4 font-medium"><b>Address :</b></td>
                    <td class="px-6 py-4">{{ $project['client_address'] ?? '-' }}</td>
                </tr>

            </tbody>
        </table>
    </div>

</div>

@include('masterlayout.footer')
