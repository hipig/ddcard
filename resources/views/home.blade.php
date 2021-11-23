@extends('layouts.app')
@section('title', '首页')

@section('content')
  <div class="flex-1 flex items-center justify-center">
    <div class="max-w-6xl mx-auto px-4 lg:px-8 w-full">
      <div class="space-y-4 text-center">
        <h3 class="text-3xl text-gray-900">识字卡后端 API </h3>
        <a href="{{ route('admin.dashboard') }}" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none md:ml-2 px-3 py-2 leading-5 text-sm rounded border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
          后台登录
        </a>
      </div>
    </div>
  </div>
  <footer class="flex flex-none items-center bg-white">
    <div class="text-center text-gray-500 flex flex-col md:text-left md:flex-row md:justify-between text-sm max-w-6xl mx-auto px-4 lg:px-8 w-full">
      <div class="pt-4 pb-1 md:pb-4">
        <a href="#" target="_blank" class="font-medium text-indigo-600 hover:text-indigo-400">嘟嘟识字卡</a> © 2021
        {!! $appSetting->copyright !!}
      </div>
      <div class="pb-4 pt-1 md:pt-4 inline-flex items-center justify-center">
        <span>由</span>
        <a href="#" target="_blank" class="font-medium text-indigo-600 hover:text-indigo-400 mx-1">hipig</a>
        <span>设计和编码</span>
        <svg class="w-4 h-4 mx-1 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
        </svg>    </div>
    </div>
  </footer>
@endsection
