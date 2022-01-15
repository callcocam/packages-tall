@php
if ($key) {
    $value = $key;
    $key = sprintf('%s.%s', $field->key, $key);
} else {
    $value =true;
    $key = $field->key;
}
@endphp
@if ($field->left_label)
    <x-checkbox :lg="$field->lg" :md="$field->md" left-label="{{ $label }}"
        value="{{$value}}"  wire:model.defer="{{ $key }}" />
@else

    <x-checkbox value="{{ $value }}" :lg="$field->lg" :md="$field->md" label="{{ $label }}" wire:model.defer="{{ $key }}" />
@endif
