@if ($route = $item->route)
    @if (\Route::has(\Arr::get($route, 0)))
        @can(\Arr::get($route, 0))
            <x-tall-nav-link active="{{ $item->isActive() }}" icon="{{ \Arr::get($item, 'icon', 'plus') }}"
                href="{{ route(\Arr::get($route, 0), \Arr::get($route, 1, [])) }}">
                {{ __($item->title) }}
            </x-tall-nav-link>
        @endcan
    @endif
@endif
