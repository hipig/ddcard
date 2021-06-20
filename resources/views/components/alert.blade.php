@props(['type' => 'info', 'icon'])

@php
    switch ($type) {
        case 'success':
            $wrapperClass = 'text-green-700 bg-green-100';
            $iconClass = 'text-green-500';
            $closeClass = 'text-green-600 hover:text-green-400 focus:ring-green-500 active:text-green-600';
            $localIcon = $icon ?? 'heroicon-s-check-circle';
            break;
        case 'error':
            $wrapperClass = 'text-red-700 bg-red-100';
            $iconClass = 'text-red-500';
            $closeClass = 'text-red-600 hover:text-red-400 focus:ring-red-500 active:text-red-600';
            $localIcon = $icon ?? 'heroicon-s-x-circle';
            break;
        case 'warning':
            $wrapperClass = 'text-orange-700 bg-orange-100';
            $iconClass = 'text-orange-500';
            $closeClass = 'text-orange-600 hover:text-orange-400 focus:ring-orange-500 active:text-orange-600';
            $localIcon = $icon ?? 'heroicon-s-exclamation';
            break;
        default:
            $wrapperClass = 'text-indigo-700 bg-indigo-100';
            $iconClass = 'text-indigo-500';
            $closeClass = 'text-indigo-600 hover:text-indigo-400 focus:ring-indigo-500 active:text-indigo-600';
            $localIcon = $icon ?? '';
            break;
    }
@endphp

<div x-data="{open: true}" x-show="open" class="p-4 md:p-5 rounded {{ $wrapperClass }}">
  <div class="flex items-center space-x-3">
    <x-dynamic-component :component="$localIcon" class="w-5 h-5 flex-none {{ $iconClass }}" />
    <h3 class="font-semibold flex-grow">
      {{ $slot }}
    </h3>
    <button type="button" x-on:click="open = false" class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-1 py-1 leading-5 text-sm border-transparent focus:ring focus:ring-opacity-50 {{ $closeClass }}">
      <x-heroicon-s-x class="w-5 h-5" />
    </button>
  </div>
</div>
