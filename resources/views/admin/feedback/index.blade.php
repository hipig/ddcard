@extends('layouts.admin')
@section('title', '留言反馈')

@section('breadcrumb')
  <x-breadcrumb.list>
    <x-breadcrumb.item href="{{ route('admin.dashboard') }}">仪表盘</x-breadcrumb.item>
    <x-breadcrumb.item href="{{ route('admin.feedback.index') }}">留言反馈</x-breadcrumb.item>
    <x-breadcrumb.item>列表</x-breadcrumb.item>
  </x-breadcrumb.list>
@endsection

@section('content')
  <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
    <div class="py-4 px-5 lg:px-6 flex-grow w-full">
      <form action="{{ route('admin.feedback.index') }}" method="get" class="space-y-3 sm:space-y-0 sm:flex sm:items-center sm:space-x-4">
        <div class="space-x-2">
          <button type="submit" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-4 py-2 leading-5 text-sm rounded border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
            <span>搜索</span>
          </button>
          <a href="{{ route('admin.feedback.index') }}" class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-4 py-2 leading-5 text-sm border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
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
            <th class="py-3 px-6">内容</th>
            <th class="py-3 px-6">反馈时间</th>
            <th class="py-3 px-6">操作</th>
          </tr>
          </thead>

          <tbody>
          @if($feedback->isNotEmpty())
            @foreach($feedback as $item)
              <tr class="border-t border-gray-100">
                <td class="py-3 px-6">
                  <div class="flex items-center space-x-3">
                    <img src="{{ $item->user->avatar }}" alt="{{ $item->user->name }}" class="inline-block w-8 h-8 rounded-full" />
                    <div class="flex flex-col">
                      <h3 class="text-gray-900 text-base font-medium">{{ $item->user->name }}</h3>
                    </div>
                  </div>
                </td>
                <td class="py-3 px-6 text-center">
                  <span class="text-gray-700">{{ $item->content }}</span>
                </td>
                <td class="py-3 px-6 text-center">
                  <span class="text-gray-500">{{ $item->created_at }}</span>
                </td>
                <td class="py-3 px-6 text-center">
                  <button x-on:click="$dispatch('submit-dialog-form', { open: true, action: `{{ route('admin.feedback.storeReply', $item) }}` })" type="button" class="inline-flex justify-center items-center space-x-1 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                    <x-heroicon-s-reply  class="w-4 h-4"/>
                    <span>回复</span>
                  </button>
                  <button x-on:click="$dispatch('confirm-delete', { open: true, action: `{{ route('admin.feedback.destroy', $item) }}` })" type="button" class="inline-flex justify-center items-center space-x-1 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                    <x-heroicon-s-trash  class="w-4 h-4"/>
                    <span>删除</span>
                  </button>
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
        {{ $feedback->withQueryString()->links('partials.admin.pagination') }}
      </div>
    </div>
  </div>
  <x-dialog.form title="添加回复">
    <div class="space-y-4">
      <div class="space-y-1">
        <label class="font-medium" for="content">回复内容</label>
        <textarea id="content" name="content" class="w-full block border border-gray-200 rounded px-3 py-2 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" rows="3" placeholder="请填写内容..."></textarea>
      </div>
    </div>
  </x-dialog.form>
  <x-dialog.confirm-delete>
    <p class="text-gray-600">是否删除该反馈？</p>
  </x-dialog.confirm-delete>
@endsection
