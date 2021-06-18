<a href="{{ $href ?? 'javascript:;' }}" class="flex items-center space-x-2 rounded py-2 px-3 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700" {{ $attributes }}>
  @if($icon)
    <x-dynamic-component :component="$icon" class="w-5 h-5 opacity-50" />
  @endif
  <span>{{ $label }}</span>
</a>
