@foreach ($items as $item)
    @if ($item->hasChilds())
        @include('menus::tailwind.item.dropdown', compact('item'))
    @else
        @include('menus::tailwind.item.link', compact('item'))
    @endif
@endforeach

