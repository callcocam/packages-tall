@if ($route = $item->route)
    @if (\Route::has(\Arr::get($route, 0)))
        @can(\Arr::get($route, 0))
            <x-tall-nav-link-dropdown icon="{{ \Arr::get($item, 'icon', 'chevron-right') }}" href="{{ route(\Arr::get($route, 0), \Arr::get($route, 1, [])) }}"
                active="{{ $item->isActive() }}">
                {{ __($item->title) }}
            </x-tall-nav-link-dropdown>
        @endcan
    @endif
@endif
