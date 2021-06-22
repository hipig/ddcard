@extends('layouts.admin')
@section('title', '卡片添加')

@section('breadcrumb')
  <x-breadcrumb.list>
    <x-breadcrumb.item href="{{ route('admin.dashboard') }}">仪表盘</x-breadcrumb.item>
    <x-breadcrumb.item href="{{ route('admin.cards.index') }}">卡片</x-breadcrumb.item>
    <x-breadcrumb.item>编辑</x-breadcrumb.item>
  </x-breadcrumb.list>
@endsection

@section('content')
  <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
    <div class="py-4 px-5 lg:px-6 flex-grow w-full bg-gray-50">
      <span class="text-gray-900">卡片编辑</span>
    </div>
    <div class="p-5 lg:p-6 flex-grow w-full">
      <form action="{{ route('admin.cards.update', $card) }}" method="post" class="space-y-6">
        <div hidden>
          @csrf
          @method('put')
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="group_id" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">分组</label>
          <select id="group_id" name="group_id" class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full md:w-3/5 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
            <option value="">请选择</option>
            @foreach($groups as $group)
              <option value="{{ $group->id }}" {{ $card->group_id == $group->id ? 'selected' : '' }}>{{ $group->zh_name }}</option>
            @endforeach
          </select>
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="zh_name" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">中文名称</label>
          <input type="text" id="zh_name" name="zh_name" value="{{ old('zh_name', $card->zh_name) }}" class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full md:w-3/5 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="请输入中文名称" />
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="en_name" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">英文名称</label>
          <input type="text" id="en_name" name="en_name" value="{{ old('en_name', $card->en_name) }}" class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full md:w-3/5 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="请输入英文名称" />
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="zh_spell" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">中文发音</label>
          <input type="text" id="zh_spell" name="zh_spell" value="{{ old('zh_spell', $card->zh_spell) }}" class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full md:w-3/5 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="请输入中文发音" />
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="en_spell" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">美式发音</label>
          <input type="text" id="en_spell" name="en_spell" value="{{ old('en_spell', $card->en_spell) }}" class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full md:w-3/5 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="请输入美式发音" />
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="uk_spell" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">英式发音</label>
          <input type="text" id="uk_spell" name="uk_spell" value="{{ old('uk_spell', $card->uk_spell) }}" class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full md:w-3/5 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="请输入英式发音" />
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="cover" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">封面</label>
          <div class="w-full md:w-3/5" x-data="filepoond()" x-init="() => initFilepond()">
            <input x-ref="filepond-cover" type="file">
            <input type="hidden" name="cover" :value="path">
          </div>
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="cover" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">样式</label>
          <div class="w-full md:w-3/5 space-x-6">
            @php
              $colorMap = [
                    'gray' => 'bg-gray-600',
                    'red' => 'bg-red-600',
                    'yellow' => 'bg-yellow-600',
                    'green' => 'bg-green-600',
                    'blue' => 'bg-blue-600',
                    'orange' => 'bg-orange-600',
                    'teal' => 'bg-teal-600',
                    'indigo' => 'bg-indigo-600',
                    'purple' => 'bg-purple-600',
                    'pink' => 'bg-pink-600',
                ];
            @endphp
            @foreach(\App\Models\Card::$colorMap as $key => $color)
              <label class="inline-flex items-center space-x-2">
                <input id="color" type="radio" name="color" value="{{ $key }}" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" {{ $card->color == $key ? 'checked' : '' }}>
                <span class="rounded w-5 h-5 {{ $colorMap[$key] }}" title="{{ $color }}"></span>
              </label>
            @endforeach
          </div>
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="cover" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">状态</label>
          <div class="w-full md:w-3/5 space-x-6">
            @foreach(\App\Models\Card::$statusMap as $key => $value)
              <label class="inline-flex items-center space-x-2">
                <input id="status" type="radio" name="status" value="{{ $key }}" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" {{ $card->status === $key ? 'checked' : '' }}>
                <span>{{ $value }}</span>
              </label>
            @endforeach
          </div>
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="index" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">排序</label>
          <input type="number" id="index" name="index" value="{{ old('index', $card->index) }}" class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full md:w-3/5 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="请输入排序" />
        </div>
        <div class="md:w-4/5 ml-auto space-x-2">
          <button type="submit" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none md:ml-6 px-4 py-2 leading-5 text-sm rounded border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
            确认
          </button>
          <button type="button" x-on:click="window.history.back()" class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-4 py-2 leading-5 text-sm border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
            返回
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ mix('vendor/filepond/filepond.css') }}">
@endpush

@push('scripts')
  <script src="{{ mix('vendor/filepond/filepond.js') }}"></script>
  <script>
    function filepoond() {
      return {
        path: `{{ old('cover', $card->cover) }}`,
        filepond: null,

        initFilepond() {
          let files = []
          if(this.path) {
            files.push({
              options: {
                type: 'local'
              },
              source: this.path
            })
          }

          FilePond.setOptions({
            server: {
              url: '/admin/filepond',
              process: {
                url: '/process',
                onload: (response) => {
                  this.path = eval('('+response+')')
                  return this.path
                }
              },
              revert: '/revert',
              restore: '/load?load=',
              load: '/load?load=',
              headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
              }
            }
          });

          this.filepond = FilePond.create(this.$refs['filepond-cover'], {
            allowMultiple: false,
            maxFiles: 1,
            acceptedFileTypes: 'image/*',
            allowImagePreview: true,
            files
          })
        }
      }
    }
  </script>
@endpush
