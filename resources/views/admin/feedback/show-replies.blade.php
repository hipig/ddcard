<div class="border border-gray-100 rounded overflow-x-auto min-w-full bg-white">
  <table class="min-w-full text-sm align-middle whitespace-nowrap">
    <thead>
    <tr class="text-gray-700 bg-gray-50 font-semibold">
      <th class="py-3 px-6">回复内容</th>
      <th class="py-3 px-6">是否查看</th>
      <th class="py-3 px-6">创建时间</th>
    </tr>
    </thead>

    <tbody>
    @if($replies->isNotEmpty())
      @foreach($replies as $reply)
        <tr class="border-t border-gray-100">
          <td class="py-3 px-6 text-center">
            <span class="text-gray-700">{{ $reply->content }}</span>
          </td>
          <td class="py-3 px-6 text-center">
            @if(!is_null($reply->viewed_at))
              <span class="inline-flex items-center rounded-full py-1 px-2.5 text-sm leading-none text-green-800 bg-green-100">是</span>
            @else
              <span class="inline-flex items-center rounded-full py-1 px-2.5 text-sm leading-none text-red-800 bg-red-100">否</span>
            @endif
          </td>
          <td class="py-3 px-6 text-center">
            <span class="text-gray-500">{{ $reply->created_at }}</span>
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
