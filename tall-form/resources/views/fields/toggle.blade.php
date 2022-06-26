<div class="mt-{{$field->mt}}">
    @if ($field->left_label)
        <x-toggle :lg="$field->lg" :md="$field->md" left-label="{{ $field->label }}"
            wire:model.defer="{{ $field->key }}" />
    @else
        <x-toggle :lg="$field->lg" :md="$field->md" label="{{ $field->label }}"
            wire:model.defer="{{ $field->key }}" />
    @endif
</div>
