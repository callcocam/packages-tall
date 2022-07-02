{{-- @canany(\Arr::get($item, 'active', [])) --}}
<x-tall-dropdown-link icon="{{ $item->icon }}" label="{{ __($item->title) }}" :active="$item->hasActiveOnChild()">
    @foreach ($item->childs as $child)
        @if ($child->hasChilds())
            @include('menus::tailwind.child.dropdown', ['item' => $child])
        @else
            @include('menus::tailwind.item.nav-link-dropdown', ['item' => $child])
        @endif
    @endforeach
</x-tall-dropdown-link>
{{-- @endcanany --}}

