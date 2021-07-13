@extends('layouts.admin')
@section('title', '会员方案')

@section('breadcrumb')
  <x-breadcrumb.list>
    <x-breadcrumb.item href="{{ route('admin.dashboard') }}">仪表盘</x-breadcrumb.item>
    <x-breadcrumb.item href="{{ route('admin.plans.index') }}">会员方案</x-breadcrumb.item>
    <x-breadcrumb.item>列表</x-breadcrumb.item>
  </x-breadcrumb.list>
@endsection

@section('content')
  <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
    <div class="py-4 px-5 lg:px-6 flex-grow w-full">
      <form action="{{ route('admin.plans.index') }}" method="get" class="space-y-3 sm:space-y-0 sm:flex sm:items-center sm:space-x-4">
        <div class="flex items-center space-x-1">
          <label for="name" class="flex-shrink-0 text-sm">名称：</label>
          <input type="text" id="name" name="name" value="{{ old('name', request()->name) }}" class="block border border-gray-200 rounded px-3 py-2 leading-5 text-sm w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="名称" />
        </div>
        <div class="space-x-2">
          <button type="submit" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-4 py-2 leading-5 text-sm rounded border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
            <span>搜索</span>
          </button>
          <a href="{{ route('admin.plans.index') }}" class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-4 py-2 leading-5 text-sm border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
            <span>清空</span>
          </a>
        </div>
      </form>
    </div>
  </div>
  <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
    <div class="p-5 lg:p-6 flex-grow w-full space-y-4">
      <a href="{{ route('admin.plans.create') }}" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-4 py-2 leading-5 text-sm rounded border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
        <x-heroicon-s-plus class="w-5 h-5 -mx-1" />
        <span>添加</span>
      </a>
      <div class="border border-gray-100 rounded overflow-x-auto min-w-full bg-white">
        <table class="min-w-full text-sm align-middle whitespace-nowrap">
          <thead>
          <tr class="text-gray-700 bg-gray-50 font-semibold">
            <th class="py-3 px-6 text-left">名称</th>
            <th class="py-3 px-6">价格</th>
            <th class="py-3 px-6">时长</th>
            <th class="py-3 px-6">状态</th>
            <th class="py-3 px-6">创建时间</th>
            <th class="py-3 px-6">操作</th>
          </tr>
          </thead>

          <tbody>
          @if($plans->isNotEmpty())
            @foreach($plans as $plan)
              <tr class="border-t border-gray-100">
                <td class="py-3 px-6">
                  <a href="{{ route('admin.plans.edit', $plan) }}" class="text-indigo-600 hover:text-indigo-700 hover:underline">{{ $plan->name }}</a>
                </td>
                <td class="py-3 px-6 text-center">
                  <span class="text-red-600">￥{{ $plan->price }}</span>
                </td>
                <td class="py-3 px-6 text-center">
                  @if($plan->period === -1)
                    <span class="inline-flex items-center rounded-full py-1 px-2.5 text-sm leading-none text-yellow-800 bg-yellow-100">永久</span>
                  @else
                    <span class="font-semibold">{{ $plan->period }}</span>
                    <span>{{ $plan->interval_text }}</span>
                  @endif
                </td>
                <td class="py-3 px-6 text-center">
                  @if($plan->status)
                    <span class="inline-flex items-center rounded-full py-1 px-2.5 text-sm leading-none text-green-800 bg-green-100">启用</span>
                  @else
                    <span class="inline-flex items-center rounded-full py-1 px-2.5 text-sm leading-none text-red-800 bg-red-100">禁用</span>
                  @endif
                </td>
                <td class="py-3 px-6 text-center">
                  <span class="text-gray-500">{{ $plan->created_at }}</span>
                </td>
                <td class="py-3 px-6 text-center">
                  <a href="#" class="inline-flex justify-center items-center space-x-1 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                    <x-heroicon-s-bookmark-alt  class="w-4 h-4"/>
                    <span>订阅记录</span>
                  </a>
                  <a href="{{ route('admin.plans.edit', $plan) }}" class="inline-flex justify-center items-center space-x-1 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                    <x-heroicon-s-pencil  class="w-4 h-4"/>
                    <span>编辑</span>
                  </a>
                  <button x-on:click="$dispatch('confirm-delete', { open: true, action: `{{ route('admin.plans.destroy', $plan) }}` })" type="button" class="inline-flex justify-center items-center space-x-1 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                    <x-heroicon-s-trash  class="w-4 h-4"/>
                    <span>删除</span>
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
        {{ $plans->withQueryString()->links('partials.admin.pagination') }}
      </div>
    </div>
  </div>
  <x-dialog.confirm-delete>
    <p class="text-gray-600">是否删除该会员方案？</p>
  </x-dialog.confirm-delete>
@endsection
