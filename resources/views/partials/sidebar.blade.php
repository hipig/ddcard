<nav
  id="page-sidebar"
  class="flex flex-col fixed top-0 left-0 bottom-0 w-full lg:w-64 h-full bg-sidebar-dark text-gray-200 z-50 transform transition-transform duration-500 ease-out"
  x-bind:class="{
      '-translate-x-full': !mobileSidebarOpen,
      'translate-x-0': mobileSidebarOpen,
      'lg:-translate-x-full': !desktopSidebarOpen,
      'lg:translate-x-0': desktopSidebarOpen,
    }"
  aria-label="Main Sidebar Navigation"
>
  <!-- Sidebar Header -->
  <div class="h-16 bg-gray-600 bg-opacity-25 flex-none flex items-center justify-between lg:justify-center px-4 w-full">
    <!-- Brand -->
    <a href="#" class="inline-flex items-center space-x-2 font-bold text-lg tracking-wide text-white-600 hover:text-white-400 text-white hover:opacity-75">
      <x-heroicon-o-cube-transparent class="w-5 h-5 text-indigo-400"></x-heroicon-o-cube-transparent>
      <span>{{ config('app.name') }}</span>
    </a>
    <!-- END Brand -->

    <!-- Close Sidebar on Mobile -->
    <div class="lg:hidden">
      <button
        type="button"
        class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm rounded border-transparent text-white opacity-75 hover:opacity-100 focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:opacity-75"
        x-on:click="mobileSidebarOpen = false"
      >
        <x-heroicon-s-x class="w-4 h-4 -mx-1"></x-heroicon-s-x>
      </button>
    </div>
    <!-- END Close Sidebar on Mobile -->
  </div>
  <!-- END Sidebar Header -->

  <!-- Sidebar Navigation -->
  <div class="overflow-y-auto">
    <div class="p-4 w-full">
      <ul class="text-gray-300 space-y-1">
        <li>
          <a href="#" class="flex items-center space-x-3 px-3 py-2 hover:bg-gray-800 hover:bg-opacity-75 hover:text-white rounded-t transition ease-out duration-100 bg-gray-800 bg-opacity-75 text-white rounded-b">
            <span class="flex-none flex items-center opacity-50">
              <x-heroicon-o-home class="w-5 h-5"></x-heroicon-o-home>
            </span>
            <span class="flex-grow">仪表盘</span>
          </a>
        </li>
        <li>
          <div class="px-3 pt-5 pb-2 text-xs font-medium uppercase tracking-wider text-gray-400">系统</div>
        </li>
        <li>
          <a href="#" class="flex items-center space-x-3 px-3 py-2 hover:bg-gray-800 hover:bg-opacity-75 hover:text-white rounded-t transition ease-out duration-100 rounded-b">
            <span class="flex-none flex items-center opacity-50">
              <x-heroicon-o-cog class="w-5 h-5"></x-heroicon-o-cog>
            </span>
            <span class="flex-grow">系统设置</span>
          </a>
        </li>
        <li x-data="{menuItemOpen: false}">
          <a
            href="#"
            class="flex items-center space-x-3 px-3 py-2 hover:bg-gray-800 hover:bg-opacity-75 hover:text-white rounded-t transition ease-out duration-100"
            x-bind:class="{
                'bg-gray-800 bg-opacity-75 text-white': menuItemOpen,
                'rounded-b': !menuItemOpen
              }"
            x-on:click="menuItemOpen = !menuItemOpen"
          >
            <span class="flex-none flex items-center opacity-50">
              <x-heroicon-o-shield-check class="w-5 h-5"></x-heroicon-o-shield-check>
            </span>
            <span class="flex-grow">权限管理</span>
            <span
              class="transform transition ease-out duration-150 opacity-75 rotate-0"
              x-bind:class="{
                  'rotate-90': !menuItemOpen,
                  'rotate-0': menuItemOpen
                }"
            >
              <x-heroicon-s-chevron-down class="w-5 h-5"></x-heroicon-s-chevron-down>
            </span>
          </a>
          <ul
            x-show="menuItemOpen"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform -translate-y-6 opacity-0"
            x-transition:enter-end="transform translate-y-0 opacity-100"
            x-transition:leave="transition ease-in duration-100 bg-transparent"
            x-transition:leave-start="transform translate-y-0 opacity-100"
            x-transition:leave-end="transform -translate-y-6 opacity-0"
            class="p-2 text-gray-400 bg-gray-800 bg-opacity-50 text-sm rounded-b"
          >
            <li>
              <a href="#" class="flex items-center px-3 py-2 transition ease-out duration-100 hover:text-white">
                <span class="flex-grow">角色</span>
              </a>
            </li>
            <li>
              <a href="#" class="flex items-center px-3 py-2 transition ease-out duration-100 hover:text-white">
                <span class="flex-grow">权限节点</span>
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#" class="flex items-center space-x-3 px-3 py-2 hover:bg-gray-800 hover:bg-opacity-75 hover:text-white rounded-t transition ease-out duration-100 rounded-b">
            <span class="flex-none flex items-center opacity-50">
              <x-heroicon-o-user class="w-5 h-5"></x-heroicon-o-user>
            </span>
            <span class="flex-grow">用户</span>
          </a>
        </li>
        <li>
          <div class="px-3 pt-5 pb-2 text-xs font-medium uppercase tracking-wider text-gray-400">测试</div>
        </li>
        <li x-data="{menuItemOpen: false}">
          <a
            href="#"
            class="flex items-center space-x-3 px-3 py-2 hover:bg-gray-800 hover:bg-opacity-75 hover:text-white rounded-t transition ease-out duration-100"
            x-bind:class="{
                'bg-gray-800 bg-opacity-75 text-white': menuItemOpen,
                'rounded-b': !menuItemOpen
              }"
            x-on:click="menuItemOpen = !menuItemOpen"
          >
            <span class="flex-none flex items-center opacity-50">
              <x-heroicon-o-menu class="w-5 h-5"></x-heroicon-o-menu>
            </span>
            <span class="flex-grow">测试菜单1</span>
            <span
              class="transform transition ease-out duration-150 opacity-75 rotate-0"
              x-bind:class="{
                  'rotate-90': !menuItemOpen,
                  'rotate-0': menuItemOpen
                }"
            >
              <x-heroicon-s-chevron-down class="w-5 h-5"></x-heroicon-s-chevron-down>
            </span>
          </a>
          <ul
            x-show="menuItemOpen"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform -translate-y-6 opacity-0"
            x-transition:enter-end="transform translate-y-0 opacity-100"
            x-transition:leave="transition ease-in duration-100 bg-transparent"
            x-transition:leave-start="transform translate-y-0 opacity-100"
            x-transition:leave-end="transform -translate-y-6 opacity-0"
            class="p-2 text-gray-400 bg-gray-800 bg-opacity-50 text-sm rounded-b"
          >
            <li>
              <a href="#" class="flex items-center px-3 py-2 transition ease-out duration-100 hover:text-white">
                <span class="flex-grow">菜单1</span>
              </a>
            </li>
            <li>
              <a href="#" class="flex items-center px-3 py-2 transition ease-out duration-100 hover:text-white">
                <span class="flex-grow">菜单2</span>
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#" class="flex items-center space-x-3 px-3 py-2 hover:bg-gray-800 hover:bg-opacity-75 hover:text-white rounded-t transition ease-out duration-100 rounded-b">
            <span class="flex-none flex items-center opacity-50">
              <x-heroicon-o-menu class="w-5 h-5"></x-heroicon-o-menu>
            </span>
            <span class="flex-grow">测试菜单2</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
  <!-- END Sidebar Navigation -->
</nav>
