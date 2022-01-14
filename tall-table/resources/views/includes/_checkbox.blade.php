@if ($checkbox)
    <td>
        <div class="flex px-2 space-x-2 align-middle">
            <x-toggle value="{{ \Arr::get($model,$checkboxAttribute) }}" lg wire:model="checkboxValues.{{$page}}.{{ \Arr::get($model,$checkboxAttribute) }}" />
        </div>
    </td>
@endif
