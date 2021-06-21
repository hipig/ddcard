@extends('layouts.admin')
@section('title', '系统设置-会员')

@section('breadcrumb')
  <nav>
    <ul class="flex items-center">
      <li>
        <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 hover:text-indigo-400">仪表盘</a>
      </li>
      <li class="px-2 sm:px-3 opacity-50">
        /
      </li>
      <li>
        <a href="javascript:;" class="text-indigo-600 hover:text-indigo-400">系统设置</a>
      </li>
      <li class="px-2 sm:px-3 opacity-50">
        /
      </li>
      <li>
        会员
      </li>
    </ul>
  </nav>
@endsection

@section('content')
  <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
    <div class="py-4 px-5 lg:px-6 flex-grow w-full bg-gray-50">
      <span class="text-gray-900">会员设置</span>
    </div>
    <div class="p-5 lg:p-6 flex-grow w-full">
      <form action="{{ route('admin.settings.update.vip') }}" method="post" class="space-y-6">
        <div hidden>
          @csrf
          @method('put')
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="price" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">售价</label>
          <input type="text" id="price" name="price" value="{{ old('price', $settings->price) }}" class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full md:w-3/5 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="请输入售价" />
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="original_price" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">原价</label>
          <input type="text" id="original_price" name="original_price" value="{{ old('original_price', $settings->original_price) }}" class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full md:w-3/5 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="请输入原价" />
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="duration" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">时长</label>
          <div class="w-full md:w-3/5 space-x-6">
            @foreach($settings->getDurationMap() as $key => $value)
              <label class="inline-flex items-center space-x-2">
                <input id="duration" type="radio" name="duration" value="{{ $key }}" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" {{ $settings->duration === $key ? 'checked' : '' }}>
                <span>{{ $value }}</span>
              </label>
            @endforeach
          </div>
        </div>
        <div class="md:w-4/5 ml-auto space-x-2">
          <button type="submit" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none md:ml-6 px-4 py-2 leading-5 text-sm rounded border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
            确认
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection
