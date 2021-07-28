<div>
  <div
    x-data="formDialog()"
    x-on:submit-dialog-form.window="event($event.detail)"
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
      class="flex flex-col rounded shadow-sm bg-white overflow-hidden w-full max-w-lg mx-auto"
      x-show="open"
      x-transition:enter="transition ease-out duration-200"
      x-transition:enter-start="transform opacity-0 scale-125"
      x-transition:enter-end="transform opacity-100 scale-100"
      x-transition:leave="transition ease-in duration-100"
      x-transition:leave-start="transform opacity-100 scale-100"
      x-transition:leave-end="transform opacity-0 scale-125"
      x-on:click.away="cancel()"
    >
      <div class="py-4 px-5 lg:px-6 w-full bg-gray-50 flex justify-between items-center">
        <h3 class="font-medium flex items-center space-x-2">
          <span>{{ $title }}</span>
        </h3>
        <div class="-my-4">
          <button
            type="button"
            class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-transparent text-gray-600 hover:text-gray-400 focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:text-gray-600"
            x-on:click="cancel()"
          >
            <x-heroicon-s-x class="w-4 h-4 -mx-1" />
          </button>
        </div>
      </div>
      <div class="p-5 lg:p-6 flex-grow w-full">
        <form x-ref="dialog-form" :action="action" method="post">
          @csrf
          {{ $slot }}
        </form>
      </div>
      <div class="py-4 px-5 lg:px-6 w-full bg-gray-50 text-right space-x-1">
        <button
          type="button"
          class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-4 py-2 leading-5 text-sm rounded border-transparent text-indigo-600 hover:text-indigo-400 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:text-indigo-600"
          x-on:click="cancel()"
        >
          取消
        </button>
        <button
          type="button"
          class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-4 py-2 leading-5 text-sm rounded border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 active:bg-indigo-700 active:border-indigo-700"
          x-on:click="confirm()"
        >
          确认
        </button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
  <script>
    function formDialog() {
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
          console.log(this.$refs['dialog-form'])
          this.$refs['dialog-form'].submit()
          this.open = false
        }
      }
    }
  </script>
@endpush
