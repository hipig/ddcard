@if($href ?? null)
  <li>
    <a href="{{ $href }}" class="text-indigo-600 hover:text-indigo-400">{{ $slot }}</a>
  </li>
  <li class="px-2 sm:px-3 opacity-50">
    /
  </li>
@else
  <li>
    <span>{{ $slot }}</span>
  </li>
@endif
