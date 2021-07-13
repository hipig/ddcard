@extends('layouts.admin')
@section('title', '系统设置-基础')

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
        基础
      </li>
    </ul>
  </nav>
@endsection

@section('content')
  <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
    <div class="py-4 px-5 lg:px-6 flex-grow w-full bg-gray-50">
      <span class="text-gray-900">基础设置</span>
    </div>
    <div class="p-5 lg:p-6 flex-grow w-full">
      <form action="{{ route('admin.settings.update.general') }}" method="post" class="space-y-6">
        <div hidden>
          @csrf
          @method('put')
        </div>
        <div class="space-y-1 md:space-y-0 md:flex md:items-center">
          <label for="daily_unlock_times" class="font-semibold md:w-1/5 flex-none md:mr-6 text-right">每日可解锁次数</label>
          <input type="number" id="daily_unlock_times" name="daily_unlock_times" value="{{ old('daily_unlock_times', $settings->daily_unlock_times) }}" class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full md:w-3/5 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="请输入每日可解锁次数" />
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
