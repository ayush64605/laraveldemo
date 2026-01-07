<div class="p-4 rounded-lg mt-4 shadow-md @if ($type === 'success') bg-green-100 text-green-800 @elseif($type === 'error') bg-red-100 text-red-800 @else bg-blue-100 text-blue-800 @endif"
    role="alert">
    <p>{{ $message }}</p>
</div>
