@extends('layouts.admin')
@section('title', '个人资料')

@section('content')
  <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
    <div class="py-4 px-5 lg:px-6 w-full bg-gray-50">
      <h3 class="flex items-center space-x-2">
        <span>个人资料</span>
      </h3>
    </div>
    <div class="p-5 lg:p-6 flex-grow w-full md:flex md:space-x-5">
      <p class="md:flex-none md:w-1/3 text-gray-500 text-sm mb-5">
        修改个人资料的昵称，密码
      </p>
      <form action="{{ route('admin.profile.update') }}" method="post" class="space-y-6 md:w-1/2">
        <div hidden>@csrf</div>
        <div class="space-y-1">
          <label for="username" class="font-medium">用户名</label>
          <input type="text" id="username" name="username" value="{{ $user->username }}" class="block border border-gray-200 bg-gray-100 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="请输入用户名" readonly />
        </div>
        <div class="space-y-1">
          <label for="name" class="font-medium">昵称</label>
          <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="请输入昵称" />
        </div>
        <div class="space-y-1">
          <label for="password" class="font-medium">密码</label>
          <input type="password" id="password" name="password" class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="请输入密码" />
          <p class="text-sm text-gray-500">留空表示不修改密码</p>
        </div>
        <div class="space-y-1">
          <label for="password_confirmation" class="font-medium">确认密码</label>
          <input type="password" id="password_confirmation" name="password_confirmation" class="block border border-gray-200 rounded px-3 py-2 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" placeholder="请输入重复密码" />
        </div>
        <button type="submit" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm rounded border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
          更新个人资料
        </button>
      </form>
    </div>
  </div>
@endsection
