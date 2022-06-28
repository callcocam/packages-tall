@if ($field->left_label)
    <x-checkbox :lg="$field->lg" :md="$field->md" left-label="{{ $field->label }}"
        value="{{$field->value}}"  wire:model.defer="{{ $field->key }}" />
@else

    <x-checkbox value="{{ $field->value }}" :lg="$field->lg" :md="$field->md" label="{{ $field->label }}" wire:model.defer="{{ $field->key }}" />
@endif
