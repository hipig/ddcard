<header
  id="page-header"
  class="flex flex-none items-center h-16 bg-white shadow-sm fixed top-0 right-0 left-0 z-30"
  x-bind:class="{
      'lg:pl-64': desktopSidebarOpen
    }"
>
  <div class="flex justify-between max-w-8xl mx-auto px-4 lg:px-8 w-full">
    <!-- Left Section -->
    <div class="flex items-center space-x-2">
      <!-- Toggle Sidebar on Desktop -->
      <div class="hidden lg:block">
        <button
          type="button"
          class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-6 rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none"
          x-on:click="desktopSidebarOpen = !desktopSidebarOpen"
        >
          <svg class="hi-solid hi-menu-alt-1 inline-block w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/></svg>
        </button>
      </div>
      <!-- END Toggle Sidebar on Desktop -->

      <!-- Toggle Sidebar on Mobile -->
      <div class="lg:hidden">
        <button
          type="button"
          class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-6 rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none"
          x-on:click="mobileSidebarOpen = true"
        >
          <x-heroicon-s-menu-alt-1 class="w-5 h-5"></x-heroicon-s-menu-alt-1>
        </button>
      </div>
      <!-- END Toggle Sidebar on Mobile -->

      <!-- Search -->
      <div class="hidden sm:block">
        <form onsubmit="return false;">
          <input type="text" class="w-full block border border-gray-200 rounded px-3 py-2 leading-5 text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" id="tk-form-layouts-search" placeholder="关键字.." />
        </form>
      </div>
      <div class="sm:hidden">
        <button type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
          <x-heroicon-s-search class="w-5 h-5"></x-heroicon-s-search>
        </button>
      </div>
      <!-- END Search -->
    </div>
    <!-- END Left Section -->

    <!-- Right Section -->
    <div class="flex items-center space-x-2">
      <x-dropdown>
        <button
          type="button"
          class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none"
        >
          <x-heroicon-o-bell class="w-5 h-5"></x-heroicon-o-bell>
          <span class="text-indigo-500">•</span>
        </button>
        <x-slot name="menu">
          <div class="w-72 bg-white ring-1 ring-black ring-opacity-5 rounded divide-y divide-gray-100">
            <ul class="py-2 divide-y divide-gray-100">
              <li>
                <a href="#" class="py-2 flex items-start hover:bg-gray-100 hover:text-gray-700">
                  <div class="mx-3">
                    <x-heroicon-s-check-circle class="w-5 h-5 text-green-500"></x-heroicon-s-check-circle>
                  </div>
                  <div class="flex-1 text-sm pr-2">
                    <div class="font-semibold">应用版本已升级至 v5.6！</div>
                    <div class="text-xs text-gray-400">3 分钟前</div>
                  </div>
                </a>
              </li>
              <li>
                <a href="#" class="py-2 flex items-start hover:bg-gray-100 hover:text-gray-700">
                  <div class="mx-3">
                    <x-heroicon-s-user-add class="w-5 h-5 text-indigo-500"></x-heroicon-s-user-add>
                  </div>
                  <div class="flex-1 text-sm pr-2">
                    <div class="font-semibold">有新的订阅用户，共计2580个！</div>
                    <div class="text-xs text-gray-400">10 分钟前</div>
                  </div>
                </a>
              </li>
              <li>
                <a href="#" class="py-2 flex items-start hover:bg-gray-100 hover:text-gray-700">
                  <div class="mx-3">
                    <x-heroicon-s-x-circle class="w-5 h-5 text-red-500"></x-heroicon-s-x-circle>
                  </div>
                  <div class="flex-1 text-sm pr-2">
                    <div class="font-semibold">服务器备份无法完成，请检查！</div>
                    <div class="text-xs text-gray-400">30 分钟前</div>
                  </div>
                </a>
              </li>
              <li>
                <a href="#" class="py-2 flex items-start hover:bg-gray-100 hover:text-gray-700">
                  <div class="mx-3">
                    <x-heroicon-s-exclamation-circle class="w-5 h-5 text-yellow-500"></x-heroicon-s-exclamation-circle>
                  </div>
                  <div class="flex-1 text-sm pr-2">
                    <div class="font-semibold">你的空间不够了，请考虑升级你的计划。</div>
                    <div class="text-xs text-gray-400">1 小时前</div>
                  </div>
                </a>
              </li>
            </ul>
            <div class="p-2">
              <button type="button" class="w-full inline-flex justify-center items-center space-x-2 rounded border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                <x-heroicon-s-eye class="w-4 h-4"></x-heroicon-s-eye>
                <span>查看全部</span>
              </button>
            </div>
          </div>
        </x-slot>
      </x-dropdown>

      <x-dropdown>
        <button
          type="button"
          class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none"
        >
          <span>{{ Auth::user()->name }}</span>
          <x-heroicon-s-chevron-down class="w-5 h-5 opacity-50"></x-heroicon-s-chevron-down>
        </button>
        <x-slot name="menu">
          <x-dropdown.menu>
            <div class="p-2 space-y-1">
              <x-dropdown.item label="个人资料" icon="heroicon-s-user-circle" href="{{ route('admin.profile') }}"></x-dropdown.item>
              <x-dropdown.item label="系统设置" icon="heroicon-s-cog" href="{{ route('admin.settings.edit.general') }}"></x-dropdown.item>
            </div>
            <div class="p-2 space-y-1">
              <x-dropdown.item label="退出登录" icon="heroicon-s-lock-closed" x-on:click="$refs['logout-form'].submit()"></x-dropdown.item>
              <form x-ref="logout-form" action="{{ route('admin.logout') }}" method="post">
                @csrf
              </form>
            </div>
          </x-dropdown.menu>
        </x-slot>
      </x-dropdown>
    </div>
    <!-- END Right Section -->
  </div>
</header>
