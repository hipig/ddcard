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
      <a href="{{ route('admin.records.subscription') }}" class="block p-3 font-medium text-sm text-center bg-gray-50 hover:bg-gray-100 hover:bg-opacity-75 active:bg-gray-50 text-indigo-600 hover:text-indigo-500">
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
        <div class="border border-gray-100 rounded overflow-x-auto min-w-full bg-white">
          <table class="min-w-full text-sm align-middle whitespace-nowrap">
            <thead>
            <tr class="text-gray-700 bg-gray-50 font-semibold">
              <th class="py-3 px-6 text-left">用户</th>
              <th>是否会员</th>
              <th>在线天数</th>
              <th>注册时间</th>
            </tr>
            </thead>

            <tbody>
            @if($latestUsers->isNotEmpty())
              @foreach($latestUsers as $user)
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
      </div>
    </div>
  </div>
@endsection
