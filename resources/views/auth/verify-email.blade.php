@extends('layouts.app')
@section('title', '验证邮箱')

@section('content')
  <!-- Patterns Background -->
  <div class="pattern-dots-md text-gray-300 absolute top-0 right-0 w-32 h-32 lg:w-48 lg:h-48 transform translate-x-16 translate-y-16"></div>
  <div class="pattern-dots-md text-gray-300 absolute bottom-0 left-0 w-32 h-32 lg:w-48 lg:h-48 transform -translate-x-16 -translate-y-16"></div>
  <!-- END Patterns Background -->

  <!-- Forgot Password Section -->
  <div class="py-6 lg:py-0 w-full md:w-8/12 lg:w-6/12 xl:w-4/12 relative">
    <!-- Header -->
    <div class="mb-8 text-center">
      <h1 class="text-4xl font-bold inline-flex items-center mb-1 space-x-3">
        <svg class="hi-solid hi-cube-transparent inline-block w-8 h-8 text-indigo-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9.504 1.132a1 1 0 01.992 0l1.75 1a1 1 0 11-.992 1.736L10 3.152l-1.254.716a1 1 0 11-.992-1.736l1.75-1zM5.618 4.504a1 1 0 01-.372 1.364L5.016 6l.23.132a1 1 0 11-.992 1.736L4 7.723V8a1 1 0 01-2 0V6a.996.996 0 01.52-.878l1.734-.99a1 1 0 011.364.372zm8.764 0a1 1 0 011.364-.372l1.733.99A1.002 1.002 0 0118 6v2a1 1 0 11-2 0v-.277l-.254.145a1 1 0 11-.992-1.736l.23-.132-.23-.132a1 1 0 01-.372-1.364zm-7 4a1 1 0 011.364-.372L10 8.848l1.254-.716a1 1 0 11.992 1.736L11 10.58V12a1 1 0 11-2 0v-1.42l-1.246-.712a1 1 0 01-.372-1.364zM3 11a1 1 0 011 1v1.42l1.246.712a1 1 0 11-.992 1.736l-1.75-1A1 1 0 012 14v-2a1 1 0 011-1zm14 0a1 1 0 011 1v2a1 1 0 01-.504.868l-1.75 1a1 1 0 11-.992-1.736L16 13.42V12a1 1 0 011-1zm-9.618 5.504a1 1 0 011.364-.372l.254.145V16a1 1 0 112 0v.277l.254-.145a1 1 0 11.992 1.736l-1.735.992a.995.995 0 01-1.022 0l-1.735-.992a1 1 0 01-.372-1.364z" clip-rule="evenodd"/></svg>
        <span>{{ config('app.name') }}</span>
      </h1>
      <p class="text-gray-500">
        忘记了密码？别担心
      </p>
    </div>
    <!-- END Header -->

    <!-- Forgot Password Form -->
    <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
      <div class="p-5 lg:p-6 flex-grow w-full">
        <div class="sm:p-5 lg:px-10 lg:py-8">
          <div class="mb-4 px-3 py-2 rounded-md text-sm text-yellow-600 bg-yellow-50">
            邮箱地址尚未验证？验证邮件已发送至您的邮箱，请您点击邮箱内的链接进行验证。如果您没有收到电子邮件，请点击再次发送
          </div>

          @if (session('status') == 'verification-link-sent')
            <div class="mb-4 px-3 py-2 rounded-md text-sm text-green-600 bg-green-50">
              新的验证邮件已发送至您的邮箱！
            </div>
          @endif

          <div class="flex items-center space-x-5">
            <form action="{{ route('verification.send') }}" method="post">
              @csrf
              <button type="submit" class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-3 py-2 leading-6 border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
                发送邮件
              </button>
            </form>
            <form action="{{ route('logout') }}" method="post">
              @csrf
              <button type="submit" class="inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-3 py-2 leading-6 border-red-700 bg-red-700 text-white hover:text-white hover:bg-red-800 hover:border-red-800 focus:ring focus:ring-red-500 focus:ring-opacity-50 active:bg-red-700 active:border-red-700">
                退出登录
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- END Forgot Password Form -->

    <!-- Footer -->
    <div class="text-sm text-gray-500 text-center mt-6">
      <a class="font-medium text-indigo-600 hover:text-indigo-400" href="#" target="_blank">{{ config('app.name') }}</a> 由 <a class="font-medium text-indigo-600 hover:text-indigo-400" href="#" target="_blank">hipig</a> 设计与编码
    </div>
    <!-- END Footer -->
  </div>
  <!-- END Forgot Password Section -->
  <div class="mt-24">
    <div class="w-full md:max-w-lg md:mx-auto">
      <div class="bg-white rounded-md shadow-sm overflow-hidden">
        <div class="py-8 px-4 md:px-10 flex flex-col">
          <div class="mb-4 px-3 py-2 rounded-md text-sm text-yellow-600 bg-yellow-50">
            邮箱地址尚未验证？验证邮件已发送至您的邮箱，请您点击邮箱内的链接进行验证。如果您没有收到电子邮件，请点击再次发送
          </div>
          @if (session('status') == 'verification-link-sent')
            <div class="mb-4 px-3 py-2 rounded-md text-sm text-green-600 bg-green-50">
              新的验证邮件已发送至您的邮箱！
            </div>
          @endif
          <div class="flex items-center space-x-5">
            <form action="{{ route('verification.send') }}" method="post">
              @csrf
              <button type="submit" class="inline-flex items-center justify-center py-2 px-5 rounded-md shadow-sm leading-snug border border-transparent text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:bg-indigo-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">发送邮件</button>
            </form>
            <form action="{{ route('logout') }}" method="post">
              @csrf
              <button type="submit" class="inline-flex items-center justify-center py-2 px-5 rounded-md shadow-sm leading-snug border border-transparent text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:bg-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150 ease-in-out">退出登录</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
