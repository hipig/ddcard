@if($slot->isEmpty())
  <li>
    <a href="{{ $href ?? 'javascript:;' }}" class="flex items-center space-x-3 px-3 py-2 hover:bg-gray-800 hover:bg-opacity-75 hover:text-white rounded-t transition ease-out duration-100 rounded-b {{ $active ?? false ? 'bg-gray-800 bg-opacity-75 text-white' : '' }}">
      @if($icon)
        <span class="flex-none flex items-center opacity-50">
          <x-dynamic-component :component="$icon" class="w-5 h-5" />
        </span>
      @endif
      <span class="flex-grow">{{ $label }}</span>
    </a>
  </li>
@else
  <li x-data="{menuItemOpen: false}">
    <a
      href="javascript:;"
      class="flex items-center space-x-3 px-3 py-2 hover:bg-gray-800 hover:bg-opacity-75 hover:text-white rounded-t transition ease-out duration-100"
      x-bind:class="{
                'bg-gray-800 bg-opacity-75 text-white': menuItemOpen,
                'rounded-b': !menuItemOpen
              }"
      x-on:click="menuItemOpen = !menuItemOpen"
    >
      @if($icon)
        <span class="flex-none flex items-center opacity-50">
          <x-dynamic-component :component="$icon" class="w-5 h-5" />
        </span>
      @endif
      <span class="flex-grow">{{ $label }}</span>
      <span
        class="transform transition ease-out duration-150 opacity-75 rotate-0"
        x-bind:class="{
                  'rotate-90': !menuItemOpen,
                  'rotate-0': menuItemOpen
                }"
      >
        <x-heroicon-s-chevron-down class="w-5 h-5"></x-heroicon-s-chevron-down>
      </span>
    </a>
    <ul
      x-show="menuItemOpen"
      x-transition:enter="transition ease-out duration-100"
      x-transition:enter-start="transform -translate-y-6 opacity-0"
      x-transition:enter-end="transform translate-y-0 opacity-100"
      x-transition:leave="transition ease-in duration-100 bg-transparent"
      x-transition:leave-start="transform translate-y-0 opacity-100"
      x-transition:leave-end="transform -translate-y-6 opacity-0"
      class="p-2 text-gray-400 bg-gray-800 bg-opacity-50 text-sm rounded-b"
    >
      {{ $slot }}
    </ul>
  </li>
@endif
