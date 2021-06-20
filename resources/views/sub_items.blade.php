<li class="flex items-center">
    <span class="mr-2">-</span>
    <input class="itemInput peer py-1 px-2 rounded-md border border-gray-300 border-opacity-0 focus:border-opacity-100 focus:outline-none transition" data-id={{ $sub_items->id }} type="text" value="{{ $sub_items->label }}">
    <button class="block bg-green-600 py-1 px-2 text-white text-xs rounded-lg ml-2">Update</button>
</li>
@if ($sub_items->items)
<ul class="ml-5 list-disc">
    @if(count($sub_items->items) > 0)
    @foreach ($sub_items->items as $subitems)
    @include('sub_items', ['sub_items' => $subitems])
    @endforeach
    @endif
</ul>
@endif