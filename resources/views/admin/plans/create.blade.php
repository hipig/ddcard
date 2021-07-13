@extends('layouts.admin')
@section('title', '会员方案添加')

@section('breadcrumb')
  <x-breadcrumb.list>
    <x-breadcrumb.item href="{{ route('admin.dashboard') }}">仪表盘</x-breadcrumb.item>
    <x-breadcrumb.item href="{{ route('admin.plans.index') }}">会员方案</x-breadcrumb.item>
    <x-breadcrumb.item>添加</x-breadcrumb.item>
  </x-breadcrumb.list>
@endsection

@section('content')
  <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
    <div class="py-4 px-5 lg:px-6 flex-grow w-full bg-gray-50">
      <span class="text-gray-900">会员方案添加</span>
    </div>
    <div class="p-5 lg:p-6 flex-grow w-full">
      <form action="{{ route('admin.plans.store') }}" method="post" class="space-y-6">
        <div hidden>
          @csrf
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="name" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">名称</label>
          <input type="text" id="name" name="name" value="{{ old('name') }}" class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full md:w-3/5 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="请输入名称" />
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="price" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">价格</label>
          <div class="md:w-3/5 relative">
              <div class="absolute inset-y-0 left-0 w-10 my-px ml-px flex items-center justify-center pointer-events-none rounded-l text-gray-500">￥</div>
              <input type="text" id="price" name="price" value="{{ old('price') }}" class="block border border-gray-200 rounded pl-10 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="请输入价格" />
          </div>
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-baseline">
          <label for="period" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">时长</label>
          <div class="md:w-3/5 space-y-1">
            <input type="number" id="period" name="period" value="{{ old('period', 1) }}" class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="请输入时长" />
            <p class="text-sm text-gray-500">若时长为<code class="px-1 text-red-500">-1</code>，则为永久</p>
          </div>
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="cover" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">周期</label>
          <div class="w-full md:w-3/5 space-x-6">
            @foreach(\App\Models\Plan::$intervalMap as $key => $text)
              <label class="inline-flex items-center space-x-2">
                <input id="interval" type="radio" name="interval" value="{{ $key }}" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" {{ old('interval', \App\Models\Plan::INTERVAL_DAY) == $key ? 'checked' : '' }}>
                <span>{{ $text }}</span>
              </label>
            @endforeach
          </div>
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="description" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">描述</label>
          <textarea id="description" name="description" class="w-full block border border-gray-200 rounded px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" rows="4" placeholder="请输入描述">{{ old('description') }}</textarea>
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="cover" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">标签</label>
          <div class="w-full md:w-3/5 space-x-6">
            <label class="inline-flex items-center space-x-2">
              <input id="tag" type="radio" name="tag" value="" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" {{ is_null(old('tag')) ? 'checked' : '' }}>
              <span>默认</span>
            </label>
            @foreach(\App\Models\Plan::$tagMap as $key => $text)
              <label class="inline-flex items-center space-x-2">
                <input id="tag" type="radio" name="tag" value="{{ $key }}" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" {{ old('tag') == $key ? 'checked' : '' }}>
                <span>{{ $text }}</span>
              </label>
            @endforeach
          </div>
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="cover" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">状态</label>
          <div class="w-full md:w-3/5 space-x-6">
            @foreach(\App\Models\Plan::$statusMap as $key => $value)
              <label class="inline-flex items-center space-x-2">
                <input id="is_lock" type="radio" name="status" value="{{ $key }}" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" {{ old('status', \App\Models\CardGroup::STATUS_ENABLE) == $key ? 'checked' : '' }}>
                <span>{{ $value }}</span>
              </label>
            @endforeach
          </div>
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="index" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">排序</label>
          <input type="number" id="index" name="index" value="{{ old('index', 99) }}" class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full md:w-3/5 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="请输入排序" />
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
