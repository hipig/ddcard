@extends('layouts.base')

@section('body')
  <!-- Page Container -->
  <div id="page-container" class="flex flex-col mx-auto w-full min-h-screen bg-gray-100">
    <!-- Page Content -->
    <main id="page-content" class="flex flex-auto flex-col max-w-full">
      <div class="min-h-screen flex items-center justify-center relative overflow-hidden max-w-10xl mx-auto p-4 lg:p-8 w-full">
        @yield('content')
      </div>
    </main>
    <!-- END Page Content -->
  </div>
  <!-- END Page Container -->
@endsection
