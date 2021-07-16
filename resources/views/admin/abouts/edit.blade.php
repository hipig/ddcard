@extends('layouts.admin')
@section('title', '关于我们编辑')

@section('breadcrumb')
  <x-breadcrumb.list>
    <x-breadcrumb.item href="{{ route('admin.dashboard') }}">仪表盘</x-breadcrumb.item>
    <x-breadcrumb.item href="{{ route('admin.abouts.index') }}">关于我们</x-breadcrumb.item>
    <x-breadcrumb.item>编辑</x-breadcrumb.item>
  </x-breadcrumb.list>
@endsection

@section('content')
  <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
    <div class="py-4 px-5 lg:px-6 flex-grow w-full bg-gray-50">
      <span class="text-gray-900">关于我们编辑</span>
    </div>
    <div class="p-5 lg:p-6 flex-grow w-full">
      <form action="{{ route('admin.abouts.update', $about) }}" method="post" class="space-y-6">
        <div hidden>
          @csrf
          @method('put')
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="name" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">名称</label>
          <input type="text" id="name" name="name" value="{{ old('name', $about->name) }}" class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full md:w-3/5 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="请输入名称" />
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="key" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">标识</label>
          <input type="text" id="key" name="key" value="{{ old('key', $about->key) }}" class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full md:w-3/5 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="请输入标识" />
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-baseline" x-data="quillEditor(`{{ old('content', $about->content) }}`)" x-init="init()">
          <label for="content" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">主要内容</label>
          <div class="md:w-3/5">
            <input type="hidden" id="content" name="content" x-model.debounce="content">
            <div x-ref="quillEditor" class="bg-white">
              {!! old('content', $about->content) !!}
            </div>
          </div>
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="cover" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">状态</label>
          <div class="w-full md:w-3/5 space-x-6">
            @foreach(\App\Models\About::$statusMap as $key => $value)
              <label class="inline-flex items-center space-x-2">
                <input id="status" type="radio" name="status" value="{{ $key }}" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" {{ old('status', $about->status) == $key ? 'checked' : '' }}>
                <span>{{ $value }}</span>
              </label>
            @endforeach
          </div>
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
  <link rel="stylesheet" href="{{ mix('vendor/quill/quill.css') }}">
@endpush

@push('beforeScripts')
  <script src="{{ mix('vendor/quill/quill.js') }}"></script>
@endpush

@push('scripts')
  <script>
    function quillEditor(content) {
      return {
        content: content,

        init() {
          let that = this
          quill = new Quill(this.$refs.quillEditor, {
            modules: {
              toolbar: {
                container: [
                  [{ 'size': ['small', false, 'large', 'huge'] }],
                  [{'header': 2}, {'header': 3}],
                  ['bold', 'italic', 'underline', 'strike'],
                  ['link', 'blockquote', 'code-block', 'image'],
                  [{ list: 'ordered' }, { list: 'bullet' }, { 'align': [false, 'center', 'right', 'justify']}]
                ]
              }
            },
            theme: 'snow',
            scrollingContainer: 'html, body',
            placeholder: '请输入内容'
          })
          quill.on('text-change', function () {
            that.content = quill.getText() ? quill.root.innerHTML : ''
          })
        }
      }
    }
  </script>
@endpush
