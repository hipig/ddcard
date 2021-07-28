<div>
  <div
    x-data="deleteDialog()"
    x-on:confirm-delete.window="event($event.detail)"
    x-show="open"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="transform opacity-0"
    x-transition:enter-end="transform opacity-100"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="transform opacity-100"
    x-transition:leave-end="transform opacity-0"
    class="z-50 fixed inset-0 overflow-y-auto overflow-x-hidden bg-gray-900 bg-opacity-75 p-4 lg:p-8"
    x-cloak
  >
    <div
      class="flex flex-col rounded shadow-sm bg-white overflow-hidden w-full max-w-md mx-auto"
      x-show="open"
      x-transition:enter="transition ease-out duration-200"
      x-transition:enter-start="transform opacity-0 scale-125"
      x-transition:enter-end="transform opacity-100 scale-100"
      x-transition:leave="transition ease-in duration-100"
      x-transition:leave-start="transform opacity-100 scale-100"
      x-transition:leave-end="transform opacity-0 scale-125"
    >
      <div class="p-5 lg:p-6 flex-grow w-full flex space-x-5">
        <div class="w-16 h-16 flex-none flex items-center justify-center rounded-full bg-red-100">
          <x-heroicon-s-shield-exclamation class="w-8 h-8 text-red-500" />
        </div>
        <div class="space-y-1">
          <h4 class="text-xl font-semibold">删除提示</h4>
          {{ $slot }}
          <form x-ref="delete-form" :action="action" method="post">
            @csrf
            @method('delete')
          </form>
        </div>
      </div>
      <div class="py-4 px-5 lg:px-6 w-full bg-gray-50 text-right space-x-1">
        <button
          type="button"
          class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-4 py-2 leading-5 text-sm rounded border-transparent text-red-600 hover:text-red-400 focus:ring focus:ring-red-500 focus:ring-opacity-50 active:text-red-600"
          x-on:click="open = false"
        >
          取消
        </button>
        <button
          type="button"
          class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-4 py-2 leading-5 text-sm rounded border-red-700 bg-red-700 text-white hover:text-white hover:bg-red-800 hover:border-red-800 focus:ring focus:ring-red-500 focus:ring-opacity-50 active:bg-red-700"
          x-on:click="confirm()"
        >
          是的，确认删除
        </button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
  <script>
    function deleteDialog() {
      return {
        open: false,
        action: '',

        event(detail) {
          this.open = !!detail.open
          this.action = detail.action
        },
        cancel() {
          this.open = false
        },
        confirm() {
          this.$refs['delete-form'].submit()
          this.open = false
        }
      }
    }
  </script>
@endpush
