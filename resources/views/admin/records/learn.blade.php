@extends('layouts.admin')
@section('title', '卡片学习记录')

@section('breadcrumb')
  <x-breadcrumb.list>
    <x-breadcrumb.item href="{{ route('admin.dashboard') }}">仪表盘</x-breadcrumb.item>
    <x-breadcrumb.item href="javascript:;">统计报告</x-breadcrumb.item>
    <x-breadcrumb.item href="{{ route('admin.records.learn') }}">卡片学习记录</x-breadcrumb.item>
    <x-breadcrumb.item>列表</x-breadcrumb.item>
  </x-breadcrumb.list>
@endsection

@section('content')
  <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
    <div class="py-4 px-5 lg:px-6 flex-grow w-full">
      <form action="{{ route('admin.records.learn') }}" method="get" class="space-y-3 sm:space-y-0 sm:flex sm:items-center sm:space-x-4">
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
          <label for="card_id" class="flex-shrink-0 text-sm">卡片：</label>
          <select id="card_id" name="card_id" class="w-28 block border border-gray-200 rounded px-3 py-2 leading-5 text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
            <option value="" {{ is_null(request()->card_id) ? 'selected' : '' }}>请选择</option>
            @foreach($groups as $group)
              <optgroup label="{{ $group->zh_name }}">
                @foreach($group->cards as $card)
                  <option value="{{ $card->id }}" {{ request()->card_id == $card->id ? 'selected' : '' }}>{{ $card->zh_name }}</option>
                @endforeach
              </optgroup>
            @endforeach
          </select>
        </div>
        <div class="space-x-2">
          <button type="submit" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-4 py-2 leading-5 text-sm rounded border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
            <span>搜索</span>
          </button>
          <a href="{{ route('admin.records.learn') }}" class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-4 py-2 leading-5 text-sm border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
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
            <th class="py-3 px-6">卡片分组</th>
            <th class="py-3 px-6">卡片</th>
            <th class="py-3 px-6">学习时间</th>
          </tr>
          </thead>

          <tbody>
          @if($records->isNotEmpty())
            @foreach($records as $record)
              <tr class="border-t border-gray-100">
                <td class="py-3 px-6">
                  <div class="flex items-center space-x-3">
                    <img src="{{ $record->user->avatar }}" alt="{{ $record->user->name }}" class="inline-block w-8 h-8 rounded-full" />
                    <div class="flex flex-col">
                      <h3 class="text-gray-900 text-base font-medium">{{ $record->user->name }}</h3>
                    </div>
                  </div>
                </td>
                <td class="py-3 px-6 text-center">
                  <a href="{{ route('admin.groups.edit', $record->group) }}" class="text-base text-indigo-600 hover:text-indigo-700 hover:underline">{{ $record->group->zh_name }}</a>
                </td>
                <td class="py-3 px-6 text-center">
                  <a href="{{ route('admin.cards.edit', $record->card) }}" class="text-base text-indigo-600 hover:text-indigo-700 hover:underline">{{ $record->card->zh_name }}</a>
                </td>
                <td class="py-3 px-6 text-center">
                  <span class="text-gray-500">{{ $record->created_at }}</span>
                </td>
              </tr>
            @endforeach
          @else
            <tr class="border-t border-gray-100">
              <td class="py-6 px-6 text-center text-gray-500" colspan="4">暂无数据。</td>
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
@endsection
