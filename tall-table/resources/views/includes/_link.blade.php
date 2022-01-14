<a class="{{ implode(' ', $action->class) }}" @if (\Route::has($action->route))
    href="{{ route($action->route, $model) }}"
    @endif
    >
    @if ($action->icon)
        <x-icon name="{{ $action->icon }}" style="{{ $action->icon_type }}" class="{{ $action->icon_class }}" />
    @endif
    {{ __($action->label) }}
</a>
