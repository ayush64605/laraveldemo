<style>
    .btn {
        background-color: {{ $themesetting->theme_color }}
    }
</style>
<button {{ $attributes }} type="{{ $type }}"
    class="rounded-md {{ $icon == 'trash' ?? 'bg-red-600' }} px-5 py-2 text-sm font-semibold text-white btn">
    <div class="flex items-baseline">
        <i class="fa-solid fa-{{ $icon ?? 'empty-set' }}"></i>&nbsp;
        <p>{{ $text }}</p>
    </div>
</button>
