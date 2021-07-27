@extends('layouts.admin')
@section('title', '留言反馈')

@section('breadcrumb')
  <x-breadcrumb.list>
    <x-breadcrumb.item href="{{ route('admin.dashboard') }}">仪表盘</x-breadcrumb.item>
    <x-breadcrumb.item href="javascript:;">统计报告</x-breadcrumb.item>
    <x-breadcrumb.item href="{{ route('admin.records.online') }}">在线时长</x-breadcrumb.item>
    <x-breadcrumb.item>列表</x-breadcrumb.item>
  </x-breadcrumb.list>
@endsection

@section('content')
  <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
    <div class="py-4 px-5 lg:px-6 flex-grow w-full">
      <form action="{{ route('admin.records.online') }}" method="get" class="space-y-3 sm:space-y-0 sm:flex sm:items-center sm:space-x-4">
        <div class="flex items-center space-x-1">
          <label for="user_id" class="flex-shrink-0 text-sm">用户：</label>
          <select id="user_id" name="user_id" class="w-28 block border border-gray-200 rounded px-3 py-2 leading-5 text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
            <option value="" {{ is_null(request()->user_id) ? 'selected' : '' }}>请选择</option>
            @foreach($filterUsers as $user)
              <option value="{{ $user->id }}" {{ request()->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="flex items-center space-x-1">
          <label for="is_show_anonymous" class="flex-shrink-0 text-sm">显示匿名：</label>
          <div class="space-x-4">
            <label class="inline-flex items-center space-x-2">
              <input id="is_show_anonymous_1" type="radio" name="is_show_anonymous" value="1" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" {{ old('is_show_anonymous', request()->is_show_anonymous ?? 1) == 1 ? 'checked' : '' }}>
              <span>是</span>
            </label>
            <label class="inline-flex items-center space-x-2">
              <input id="is_show_anonymous_2" type="radio" name="is_show_anonymous" value="2" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" {{ old('is_show_anonymous', request()->is_show_anonymous ?? 1) == 2 ? 'checked' : '' }}>
              <span>否</span>
            </label>
          </div>
        </div>
        <div class="space-x-2">
          <button type="submit" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-4 py-2 leading-5 text-sm rounded border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
            <span>搜索</span>
          </button>
          <a href="{{ route('admin.records.online') }}" class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-4 py-2 leading-5 text-sm border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
            <span>清空</span>
          </a>
        </div>
      </form>
    </div>
  </div>
  <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
    <div class="p-5 lg:p-6 flex-grow w-full space-y-4">
      <div class="border border-gray-100 rounded overflow-x-auto min-w-full bg-white">
        <table class="min-w-full text-sm align-middle whitespace-nowrap">
          <thead>
          <tr class="text-gray-700 bg-gray-50 font-semibold">
            <th class="py-3 px-6 text-left">用户</th>
            <th class="py-3 px-6">日期</th>
            <th class="py-3 px-6">时长（分钟）</th>
            <th class="py-3 px-6">开始时间</th>
            <th class="py-3 px-6">结束时间</th>
            <th class="py-3 px-6">操作</th>
          </tr>
          </thead>

          <tbody>
          @if($records->isNotEmpty())
            @foreach($records as $record)
              <tr class="border-t border-gray-100">
                <td class="py-3 px-6">
                  @if($record->user)
                    <div class="flex items-center space-x-3">
                      <img src="{{ $record->user->avatar }}" alt="{{ $record->user->name }}" class="inline-block w-8 h-8 rounded-full" />
                      <div class="flex flex-col">
                        <h3 class="text-gray-900 text-base font-medium">{{ $record->user->name }}</h3>
                      </div>
                    </div>
                  @else
                    <div class="flex items-center space-x-3">
                      <div class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 text-gray-300">
                        <x-heroicon-s-user class="w-5 h-5"/>
                      </div>
                      <div class="flex flex-col">
                        <h3 class="text-gray-500 text-base font-medium">匿名</h3>
                      </div>
                    </div>
                  @endif
                </td>
                <td class="py-3 px-6 text-center">
                  <span class="text-gray-700">{{ $record->date->format('Y-m-d') }}</span>
                </td>
                <td class="py-3 px-6 text-center">
                  <span class="text-gray-700">{{ $record->duration }}</span>
                </td>
                <td class="py-3 px-6 text-center">
                  <span class="text-gray-500">{{ $record->created_at }}</span>
                </td>
                <td class="py-3 px-6 text-center">
                  <span class="text-gray-500">{{ $record->updated_at }}</span>
                </td>
                <td class="py-3 px-6 text-center">
                  <button x-on:click="$dispatch('init-dialog-list', { open: true, action: `{{ route('admin.records.online.showItems', $record) }}` })" type="button" class="inline-flex justify-center items-center space-x-1 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                    <x-heroicon-s-eye  class="w-4 h-4"/>
                    <span>详情</span>
                  </button>
                </td>
              </tr>
            @endforeach
          @else
            <tr class="border-t border-gray-100">
              <td class="py-6 px-6 text-center text-gray-500" colspan="6">暂无数据。</td>
            </tr>
          @endif
          </tbody>
        </table>
      </div>
      <div>
        {{ $records->withQueryString()->links('partials.admin.pagination') }}
      </div>
    </div>
  </div>
  <x-dialog.list title="在线详情"></x-dialog.list>
@endsection
