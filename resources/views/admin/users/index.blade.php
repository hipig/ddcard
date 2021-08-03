@extends('layouts.admin')
@section('title', '用户列表')

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
        <a href="{{ route('admin.users.index') }}" class="text-indigo-600 hover:text-indigo-400">用户管理</a>
      </li>
      <li class="px-2 sm:px-3 opacity-50">
        /
      </li>
      <li>
        列表
      </li>
    </ul>
  </nav>
@endsection

@section('content')
  <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
    <div class="py-4 px-5 lg:px-6 flex-grow w-full">
      <form action="{{ route('admin.users.index') }}" method="get" class="space-y-3 sm:space-y-0 sm:flex sm:items-center sm:space-x-4">
        <div class="flex items-center space-x-1">
          <label for="name" class="flex-shrink-0 text-sm">昵称：</label>
          <input type="text" id="name" name="name" value="{{ old('name', request()->name) }}" class="block border border-gray-200 rounded px-3 py-2 leading-5 text-sm w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="昵称" />
        </div>
        <div class="flex items-center space-x-1">
          <label for="phone" class="flex-shrink-0 text-sm">手机号码：</label>
          <input type="text" id="phone" name="phone" value="{{ old('phone', request()->phone) }}" class="block border border-gray-200 rounded px-3 py-2 leading-5 text-sm w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="手机号码" />
        </div>
        <button type="submit" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-4 py-2 leading-5 text-sm rounded border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
          <span>搜索</span>
        </button>
      </form>
    </div>
  </div>
  <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
    <div class="p-5 lg:p-6 flex-grow w-full space-y-4">
      <button type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-4 py-2 leading-5 text-sm rounded border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
        <x-heroicon-s-plus class="w-5 h-5 -mx-1" />
        <span>添加</span>
      </button>
      <div class="border border-gray-100 rounded overflow-x-auto min-w-full bg-white">
        <table class="min-w-full text-sm align-middle whitespace-nowrap">
          <thead>
          <tr class="text-gray-700 bg-gray-50 font-semibold">
            <th class="py-3 px-6 text-left">用户</th>
            <th>是否会员</th>
            <th>在线天数</th>
            <th>注册时间</th>
            <th>操作</th>
          </tr>
          </thead>

          <tbody>
            @if($users->isNotEmpty())
              @foreach($users as $user)
                <tr class="border-t border-gray-100">
                  <td class="py-3 px-6">
                    <div class="flex items-center space-x-3">
                      <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="inline-block w-8 h-8 rounded-full" />
                      <div class="flex flex-col">
                        <h3 class="text-gray-900 text-base font-medium">{{ $user->name }}</h3>
                      </div>
                    </div>
                  </td>
                  <td class="py-3 px-6 text-center">
                    @php
                      $expiredAt = $user->vip_expired_at;

                      if (is_null($expiredAt)) {
                        $labelClass = 'text-gray-800 bg-gray-100';
                        $labelText = '未开通';
                      }

                      if (!is_null($expiredAt) && $expiredAt < now()) {
                        $labelText = '已过期';
                      }

                      if (!is_null($expiredAt) && $expiredAt >= now()) {
                        $labelClass = 'text-green-800 bg-green-100';
                        $labelText = '已开通';
                      }

                      if ($expiredAt === \App\Models\Plan::INFINITE_TIME) {
                        $labelClass = 'text-yellow-800 bg-yellow-100';
                        $labelText = '永久会员';
                      }
                    @endphp

                    <span class="inline-flex items-center rounded-full py-1 px-2.5 text-sm leading-none {{ $labelClass }}">{{ $labelText }}</span>
                  </td>
                  <td class="py-3 px-6 text-center">
                    <a href="{{ route('admin.records.online', ['user_id' => $user->id]) }}" class="text-base text-indigo-600 hover:text-indigo-700 hover:underline">{{ $user->online_records_count }}</a>
                  </td>
                  <td class="py-3 px-6 text-center">
                    <span class="text-gray-500">{{ $user->created_at }}</span>
                  </td>
                  <td class="py-3 px-6 text-center">
                    <button x-on:click="$dispatch('submit-dialog-form', { open: true, action: `{{ route('admin.users.renew', $user) }}` })" type="button" class="inline-flex justify-center items-center space-x-1 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                      <x-heroicon-s-gift  class="w-4 h-4"/>
                      <span>开通会员</span>
                    </button>
                    <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex justify-center items-center space-x-1 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                      <x-heroicon-s-pencil  class="w-4 h-4"/>
                      <span>编辑</span>
                    </a>
                  </td>
                </tr>
              @endforeach
            @else
              <tr class="border-t border-gray-100">
                <td class="py-6 px-6 text-center text-gray-500" colspan="5">暂无数据。</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
      <div>
        {{ $users->withQueryString()->links('partials.admin.pagination') }}
      </div>
    </div>
  </div>
  <x-dialog.form title="开通会员">
    <div class="space-y-4">
      <div class="space-y-1">
        <label class="font-medium" for="plan_id">会员方案</label>
        <select id="plan_id" name="plan_id" class="block border border-gray-200 rounded px-3 py-2 leading-5 text-sm w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
          <option value="">请选择</option>
          @foreach($plans as $plan)
            <option value="{{ $plan->id }}" {{ old('plan_id') == $plan->id ? 'selected' : '' }}>{{ $plan->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </x-dialog.form>
@endsection
