<div class="border border-gray-100 rounded overflow-x-auto min-w-full bg-white">
  <table class="min-w-full text-sm align-middle whitespace-nowrap">
    <thead>
    <tr class="text-gray-700 bg-gray-50 font-semibold">
      <th class="py-3 px-6">日期</th>
      <th class="py-3 px-6">开始时间</th>
      <th class="py-3 px-6">结束时间</th>
    </tr>
    </thead>

    <tbody>
    @if($items->isNotEmpty())
      @foreach($items as $item)
        <tr class="border-t border-gray-100">
          <td class="py-3 px-6 text-center">
            <span class="text-gray-700">{{ $item->record->date->format('Y-m-d') }}</span>
          </td>
          <td class="py-3 px-6 text-center">
            <span class="text-gray-500">{{ $item->started_at }}</span>
          </td>
          <td class="py-3 px-6 text-center">
            <span class="text-gray-500">{{ $item->ended_at }}</span>
          </td>
        </tr>
      @endforeach
    @else
      <tr class="border-t border-gray-100">
        <td class="py-6 px-6 text-center text-gray-500" colspan="3">暂无数据。</td>
      </tr>
    @endif
    </tbody>
  </table>
</div>
