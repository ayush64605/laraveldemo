@section('title', 'Home')
@include('masterlayout.header')
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
            class="group flex shadow-xl flex-col h-full bg-blue-600 border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="p-4 md:p-6">
                <h3 class="text-2xl font-semibold text-white">
                    Total Projects
                </h3>
                <p class="mt-3 text-white text-xl">
                    {{ count($projects) }}
                </p>
            </div>
        </div>
        <div
            class="group flex shadow-xl flex-col h-full bg-orange-600 border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="p-4 md:p-6">
                <h3 class="text-2xl font-semibold text-white">
                    Total Active Projects
                </h3>
                <p class="mt-3 text-white text-xl">
                    {{ collect($projects)->where('status', 'Active')->count() }}
                </p>
            </div>
        </div>
        <div
            class="group flex shadow-xl flex-col h-full bg-yellow-600 border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="p-4 md:p-6">
                <h3 class="text-2xl font-semibold text-white">
                    Total Completed Projects
                </h3>
                <p class="mt-3 text-white text-xl">
                    {{ collect($projects)->where('status', 'Completed')->count() }}
                </p>
            </div>
        </div>
    </div>
</div>
@include('masterlayout.footer')
