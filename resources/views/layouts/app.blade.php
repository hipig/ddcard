@extends('layouts.base')

@section('body')
  <!-- Page Container -->
  <div
    class="flex flex-col mx-auto w-full min-h-screen"
  >
    <!-- Page Content -->
      @yield('content')
    <!-- END Page Content -->
  </div>
  <!-- END Page Container -->
@endsection
