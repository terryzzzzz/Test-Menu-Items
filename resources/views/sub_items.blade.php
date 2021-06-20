<li>{{ $sub_items->label }}</li>
@if ($sub_items->items)
<ul class="ml-5">
    @if(count($sub_items->items) > 0)
    @foreach ($sub_items->items as $subitems)
    @include('sub_items', ['sub_items' => $subitems])
    @endforeach
    @endif
</ul>
@endif