@if($errors->count() > 0)
  <div class="p-4 md:p-5 rounded text-red-700 bg-red-100 mb-6">
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
  </div>
@endif
