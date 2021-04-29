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
    @include('partials.sidebar')
    <!-- Page Sidebar -->

    <!-- Page Header -->
    @include('partials.header')
    <!-- END Page Header -->

    <!-- Page Content -->
    <main id="page-content" class="flex flex-auto flex-col max-w-full pt-16">
      <!-- Page Section -->
      <div class="max-w-10xl mx-auto p-4 lg:p-8 w-full">

        @yield('content')

      </div>
      <!-- END Page Section -->
    </main>
    <!-- END Page Content -->

    <!-- Page Footer -->
    @include('partials.footer')
    <!-- END Page Footer -->
  </div>
  <!-- END Page Container -->
@endsection

@push('scripts')
  <script>
    function pageContainer() {
      return {
        notificationDropdownOpen: false,
        userDropdownOpen: false,
        desktopSidebarOpen: true,
        mobileSidebarOpen: false
      }
    }
  </script>
@endpush
