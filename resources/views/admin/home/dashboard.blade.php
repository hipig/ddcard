@extends('layouts.admin')
@section('title', '仪表盘')

@section('content')
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4 lg:gap-8">
    <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
      <div class="p-5 lg:p-6 flex-grow w-full flex justify-between items-center">
        <dl>
          <dt class="text-2xl font-semibold">
            ￥{{ $counts['income'] }}
          </dt>
          <dd class="uppercase font-medium text-sm text-gray-500 tracking-wider">
            新增收益
          </dd>
        </dl>
        <div class="flex justify-center items-center rounded-xl w-12 h-12 bg-indigo-50">
          <x-heroicon-s-currency-yen class="w-8 h-8 text-indigo-600"></x-heroicon-s-currency-yen>
        </div>
      </div>
      <a href="{{ route('admin.users.index') }}" class="block p-3 font-medium text-sm text-center bg-gray-50 hover:bg-gray-100 hover:bg-opacity-75 active:bg-gray-50 text-indigo-600 hover:text-indigo-500">
        查看收益
      </a>
    </div>
    <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
      <div class="p-5 lg:p-6 flex-grow w-full flex justify-between items-center">
        <dl>
          <dt class="text-2xl font-semibold">
            {{ $counts['user'] }}
          </dt>
          <dd class="uppercase font-medium text-sm text-gray-500 tracking-wider">
            新增用户
          </dd>
        </dl>
        <div class="flex justify-center items-center rounded-xl w-12 h-12 bg-indigo-50">
          <x-heroicon-s-user class="w-8 h-8 text-indigo-600"></x-heroicon-s-user>
        </div>
      </div>
      <a href="{{ route('admin.users.index') }}" class="block p-3 font-medium text-sm text-center bg-gray-50 hover:bg-gray-100 hover:bg-opacity-75 active:bg-gray-50 text-indigo-600 hover:text-indigo-500">
        查看用户
      </a>
    </div>
    <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
      <div class="p-5 lg:p-6 flex-grow w-full flex justify-between items-center">
        <dl>
          <dt class="text-2xl font-semibold">
            {{ $counts['group'] }}
          </dt>
          <dd class="uppercase font-medium text-sm text-gray-500 tracking-wider">
            总分组数
          </dd>
        </dl>
        <div class="flex justify-center items-center rounded-xl w-12 h-12 bg-indigo-50">
          <x-heroicon-s-folder-open class="w-8 h-8 text-indigo-600"></x-heroicon-s-folder-open>
        </div>
      </div>
      <a href="{{ route('admin.groups.index') }}" class="block p-3 font-medium text-sm text-center bg-gray-50 hover:bg-gray-100 hover:bg-opacity-75 active:bg-gray-50 text-indigo-600 hover:text-indigo-500">
        查看分组
      </a>
    </div>
    <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
      <div class="p-5 lg:p-6 flex-grow w-full flex justify-between items-center">
        <dl>
          <dt class="text-2xl font-semibold">
            {{ $counts['card'] }}
          </dt>
          <dd class="uppercase font-medium text-sm text-gray-500 tracking-wider">
            总卡片数
          </dd>
        </dl>
        <div class="flex justify-center items-center rounded-xl w-12 h-12 bg-indigo-50">
          <x-heroicon-s-clipboard-list class="w-8 h-8 text-indigo-600"></x-heroicon-s-clipboard-list>
        </div>
      </div>
      <a href="{{ route('admin.cards.index') }}" class="block p-3 font-medium text-sm text-center bg-gray-50 hover:bg-gray-100 hover:bg-opacity-75 active:bg-gray-50 text-indigo-600 hover:text-indigo-500">
        查看卡片
      </a>
    </div>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-8">
    <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
      <div class="py-4 px-5 lg:px-6 w-full bg-gray-50">
        <h3 class="text-gray-900">最近用户</h3>
      </div>
      <div class="p-5 lg:p-6 flex-grow w-full">
        <p>
          这里是最近新增的用户。。。
        </p>
      </div>
    </div>
  </div>
@endsection
