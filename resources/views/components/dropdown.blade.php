<div class="relative inline-block" x-data="{open: false}">
  <div class="inline-block" x-on:click="open = true">
    {{ $slot }}
  </div>
  @if(!$menu->isEmpty())
    <div
      x-show="open"
      x-transition:enter="transition ease-out duration-150"
      x-transition:enter-start="transform opacity-0 scale-75"
      x-transition:enter-end="transform opacity-100 scale-100"
      x-transition:leave="transition ease-in duration-100"
      x-transition:leave-start="transform opacity-100 scale-100"
      x-transition:leave-end="transform opacity-0 scale-75"
      x-on:click.away="open = false"
      role="menu"
      class="absolute right-0 origin-top-right mt-2 shadow-xl rounded z-1"
    >
      {{ $menu }}
    </div>
  @endif
</div>
