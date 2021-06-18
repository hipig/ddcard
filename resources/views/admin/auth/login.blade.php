@extends('layouts.auth')
@section('title', '登录')

@section('content')
  <!-- Patterns Background -->
  <div class="pattern-dots-md text-gray-300 absolute top-0 right-0 w-32 h-32 lg:w-48 lg:h-48 transform translate-x-16 translate-y-16"></div>
  <div class="pattern-dots-md text-gray-300 absolute bottom-0 left-0 w-32 h-32 lg:w-48 lg:h-48 transform -translate-x-16 -translate-y-16"></div>
  <!-- END Patterns Background -->

  <!-- Sign In Section -->
  <div class="py-6 lg:py-0 w-full md:w-8/12 lg:w-6/12 xl:w-4/12 relative">
    <!-- Header -->
    <div class="mb-8 text-center">
      <h1 class="text-4xl font-bold inline-flex items-center mb-1 space-x-3">
        <svg class="hi-solid hi-cube-transparent inline-block w-8 h-8 text-indigo-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9.504 1.132a1 1 0 01.992 0l1.75 1a1 1 0 11-.992 1.736L10 3.152l-1.254.716a1 1 0 11-.992-1.736l1.75-1zM5.618 4.504a1 1 0 01-.372 1.364L5.016 6l.23.132a1 1 0 11-.992 1.736L4 7.723V8a1 1 0 01-2 0V6a.996.996 0 01.52-.878l1.734-.99a1 1 0 011.364.372zm8.764 0a1 1 0 011.364-.372l1.733.99A1.002 1.002 0 0118 6v2a1 1 0 11-2 0v-.277l-.254.145a1 1 0 11-.992-1.736l.23-.132-.23-.132a1 1 0 01-.372-1.364zm-7 4a1 1 0 011.364-.372L10 8.848l1.254-.716a1 1 0 11.992 1.736L11 10.58V12a1 1 0 11-2 0v-1.42l-1.246-.712a1 1 0 01-.372-1.364zM3 11a1 1 0 011 1v1.42l1.246.712a1 1 0 11-.992 1.736l-1.75-1A1 1 0 012 14v-2a1 1 0 011-1zm14 0a1 1 0 011 1v2a1 1 0 01-.504.868l-1.75 1a1 1 0 11-.992-1.736L16 13.42V12a1 1 0 011-1zm-9.618 5.504a1 1 0 011.364-.372l.254.145V16a1 1 0 112 0v.277l.254-.145a1 1 0 11.992 1.736l-1.735.992a.995.995 0 01-1.022 0l-1.735-.992a1 1 0 01-.372-1.364z" clip-rule="evenodd"/></svg>
        <span>{{ config('app.name') }}</span>
      </h1>
      <p class="text-gray-500">
        欢迎您，请登录您的账户
      </p>
    </div>
    <!-- END Header -->

    <!-- Sign In Form -->
    <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
      <div class="p-5 lg:p-6 flex-grow w-full">
        <div class="sm:p-5 lg:px-10 lg:py-8">
          <form action="{{ route('admin.login') }}" method="post" class="space-y-6">
            <div hidden>
              @csrf
            </div>
            <div class="space-y-1">
              <label for="username" class="font-medium">用户名</label>
              <input
                type="text"
                id="username"
                name="username"
                value="{{ old('username') }}"
                class="block border rounded px-5 py-3 leading-6 w-full focus:ring focus:ring-opacity-50 {{ $errors->has('username') ? 'text-red-700 border-red-400 focus:border-red-500 focus:ring-red-500' : 'border-gray-200 focus:border-indigo-500 focus:ring-indigo-500' }}"
                placeholder="请输入用户名"
              />
              @error('username')
                <p class="text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="space-y-1">
              <label for="password" class="font-medium">密码</label>
              <input
                type="password"
                id="password"
                name="password"
                class="block border rounded px-5 py-3 leading-6 w-full focus:ring focus:ring-opacity-50 {{ $errors->has('password') ? 'text-red-700 border-red-400 focus:border-red-500 focus:ring-red-500' : 'border-gray-200 focus:border-indigo-500 focus:ring-indigo-500' }}"
                placeholder="请输入密码"
              />
              @error('password')
                <p class="text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div class="flex items-center">
              <label for="remember">
                <input type="checkbox" id="remember" name="remember" class="border border-gray-200 rounded h-4 w-4 text-indigo-500 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" />
                <span class="ml-2">记住密码</span>
              </label>
            </div>
            <button type="submit" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none w-full px-4 py-3 leading-6 rounded border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
              登录
            </button>
          </form>
        </div>
      </div>
    </div>
    <!-- END Sign In Form -->

    <!-- Footer -->
    <div class="text-sm text-gray-500 text-center mt-6">
      <a class="font-medium text-indigo-600 hover:text-indigo-400" href="#" target="_blank">{{ config('app.name') }}</a> 由 <a class="font-medium text-indigo-600 hover:text-indigo-400" href="#" target="_blank">hipig</a> 设计与编码
    </div>
    <!-- END Footer -->
  </div>
  <!-- END Sign In Section -->
@endsection
