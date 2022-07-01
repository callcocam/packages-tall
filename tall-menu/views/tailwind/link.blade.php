@if (\Route::has($route))
    @can($route)
        <x-tall-nav-link icon="{{  $icon }}"
            href="{{ route($route, $params) }}" :active="$active">
            {{ __($label) }}
        </x-tall-nav-link>
    @endcan
@endif
