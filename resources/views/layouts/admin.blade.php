@extends('layouts.base')

@section('body')
  <!-- Page Container -->
  <div
    id="page-container"
    x-data="pageContainer()"
    class="flex flex-col mx-auto w-full min-h-screen"
    x-bind:class="{
        'lg:pl-64': desktopSidebarOpen
      }"
  >
    <!-- Page Sidebar -->
    @include('partials.admin.sidebar')
    <!-- Page Sidebar -->

    <!-- Page Header -->
    @include('partials.admin.header')
    <!-- END Page Header -->

    <!-- Page Content -->
    <main id="page-content" class="flex flex-auto flex-col max-w-full pt-16">
      <!-- Page Section -->
      <div class="max-w-8xl mx-auto p-4 lg:p-8 w-full">

        @include('partials.admin.message')

        @yield('content')

      </div>
      <!-- END Page Section -->
    </main>
    <!-- END Page Content -->

    <!-- Page Footer -->
    @include('partials.admin.footer')
    <!-- END Page Footer -->
  </div>
  <!-- END Page Container -->
@endsection

@push('scripts')
  <script>
    function pageContainer() {
      return {
        desktopSidebarOpen: true,
        mobileSidebarOpen: false
      }
    }
  </script>
@endpush
