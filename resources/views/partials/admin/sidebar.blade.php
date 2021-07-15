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
    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center space-x-2 font-bold text-lg tracking-wide text-white-600 hover:text-white-400 text-white hover:opacity-75">
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
  <div class="sidebar-scroll-section" data-simplebar>
    <x-sidebar.menu>
      <x-sidebar.item label="仪表盘" icon="heroicon-o-home" href="{{ route('admin.dashboard') }}" :active="if_route_pattern('admin.dashboard')"></x-sidebar.item>
      <x-sidebar.group label="系统">
        <x-sidebar.item label="系统设置" icon="heroicon-o-cog" :active="if_route_pattern('admin.settings.*')">
          <x-sidebar.subitem label="基础" href="{{ route('admin.settings.edit.general') }}" :active="if_route('admin.settings.edit.general')"></x-sidebar.subitem>
        </x-sidebar.item>
        <x-sidebar.item label="管理员" icon="heroicon-o-shield-check"></x-sidebar.item>
        <x-sidebar.item label="角色" icon="heroicon-o-lock-closed"></x-sidebar.item>
        <x-sidebar.item label="用户" icon="heroicon-o-user" href="{{ route('admin.users.index') }}" :active="if_route_pattern('admin.users.*')"></x-sidebar.item>
        <x-sidebar.item label="会员方案" icon="heroicon-o-server" href="{{ route('admin.plans.index') }}" :active="if_route_pattern('admin.plans.*')"></x-sidebar.item>
      </x-sidebar.group>
      <x-sidebar.group label="应用">
        <x-sidebar.item label="卡片分组" icon="heroicon-o-folder-open" href="{{ route('admin.groups.index') }}" :active="if_route_pattern('admin.groups.*')"></x-sidebar.item>
        <x-sidebar.item label="卡片" icon="heroicon-o-clipboard-list" href="{{ route('admin.cards.index') }}" :active="if_route_pattern('admin.cards.*')"></x-sidebar.item>
        <x-sidebar.item label="统计报告" icon="heroicon-o-chart-square-bar" :active="if_route_pattern('admin.records.*')">
          <x-sidebar.subitem label="会员订阅" href="{{ route('admin.records.subscription') }}" :active="if_route('admin.records.subscription')"></x-sidebar.subitem>
          <x-sidebar.subitem label="卡组解锁" href="{{ route('admin.records.unlock') }}" :active="if_route('admin.records.unlock')"></x-sidebar.subitem>
          <x-sidebar.subitem label="收藏记录" href="{{ route('admin.records.collect') }}" :active="if_route('admin.records.collect')"></x-sidebar.subitem>
          <x-sidebar.subitem label="在线时长"></x-sidebar.subitem>
          <x-sidebar.subitem label="卡片学习记录" href="{{ route('admin.records.learn') }}" :active="if_route('admin.records.learn')"></x-sidebar.subitem>
        </x-sidebar.item>
      </x-sidebar.group>
      <x-sidebar.group label="其他">
        <x-sidebar.item label="留言反馈" icon="heroicon-o-chat-alt" href="{{ route('admin.feedback.index') }}" :active="if_route_pattern('admin.feedback.*')"></x-sidebar.item>
        <x-sidebar.item label="关于我们" icon="heroicon-o-exclamation-circle"></x-sidebar.item>
      </x-sidebar.group>
    </x-sidebar.menu>
  </div>
  <!-- END Sidebar Navigation -->
</nav>
