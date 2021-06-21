@if($errors->count() > 0)
  <div x-data="{open: true}" x-show="open" class="p-4 md:p-5 rounded text-red-700 bg-red-100 relative">
    <div class="flex items-center mb-3 space-x-3">
      <x-heroicon-s-x-circle class="w-5 h-5 flex-none text-red-500" />
      <h3 class="font-semibold">
        请检查以下错误：
      </h3>
    </div>
    <ul class="list-inside ml-8 space-y-2">
      @foreach($errors->all() as $message)
        <li class="flex items-center space-x-2">
          <x-heroicon-s-arrow-narrow-right class="w-4 h-4 flex-none" />
          <span>{{ $message }}</span>
        </li>
      @endforeach
    </ul>
    <div class="absolute top-0 right-0 mt-4 mr-4 md:mt-5 md:mr-5">
      <button type="button" x-on:click="open = false" class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-1 py-1 leading-5 text-sm border-transparent focus:ring focus:ring-opacity-50 text-red-600 hover:text-red-400 focus:ring-red-500 active:text-red-600">
        <x-heroicon-s-x class="w-5 h-5" />
      </button>
    </div>
  </div>
@endif

@if(session('info'))
  <x-alert type="info">{{ session('info') }}</x-alert>
@endif

@if(session('warning'))
  <x-alert type="warning">{{ session('warning') }}</x-alert>
@endif

@if(session('success'))
  <x-alert type="success">{{ session('success') }}</x-alert>
@endif

@if(session('error'))
  <x-alert type="error">{{ session('error') }}</x-alert>
@endif
