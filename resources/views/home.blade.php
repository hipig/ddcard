@extends('layouts.app')
@section('title', '首页')

@section('content')
  <div class="flex flex-col items-center justify-center min-h-screen">
    <div class="space-y-4 text-center">
      <h3 class="text-3xl text-gray-900">识字卡后端 API </h3>
      <a href="{{ route('admin.dashboard') }}" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none md:ml-2 px-3 py-2 leading-5 text-sm rounded border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700">
        后台登录
      </a>
    </div>
  </div>
@endsection
