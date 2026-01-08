<button {{ $attributes }} type="{{ $type }}"
    class="rounded-md bg-{{ $color }}-600 px-5 py-2 text-sm font-semibold text-white hover:bg-{{ $color }}-500">
    <div class="flex items-baseline">
        <i class="fa-solid fa-{{ $icon ?? 'empty-set' }}"></i>&nbsp;
        <p>{{ $text }}</p>
    </div>
</button>
