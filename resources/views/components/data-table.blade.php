@props([
    'title' => null,
    'description' => null,
    'actions' => null,
])

<div class="bg-white rounded-xl border border-gray-200 shadow-sm">

    {{-- ===== Header ===== --}}
    @if ($title || $actions)
        <div class="px-6 py-4 border-b flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                @if ($title)
                    <h2 class="text-lg font-semibold text-gray-900">
                        {{ $title }}
                    </h2>
                @endif

                @if ($description)
                    <p class="text-sm text-gray-500">
                        {{ $description }}
                    </p>
                @endif
            </div>

            @if ($actions)
                <div class="flex gap-2 flex-wrap">
                    {{ $actions }}
                </div>
            @endif
        </div>
    @endif

    {{-- ===== Table ===== --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            {{ $slot }}
        </table>
    </div>

    {{-- ===== Footer ===== --}}
    @isset($footer)
        <div class="px-6 py-3 border-t bg-gray-50 text-sm text-gray-600">
            {{ $footer }}
        </div>
    @endisset

</div>
