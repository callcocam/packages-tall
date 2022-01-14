@if($field->option_key_label && $field->option_key_value)
<x-native-select
    label="{{ $field->label }}"
    placeholder="{{ $field->placeholder }}"
    option-label="{{ $field->option_label }}"
    option-value="{{ $field->option_value }}"
    option-key-label="{{ $field->option_key_label }}"
    option-key-value="{{ $field->option_key_value }}"
    :options="$field->options"
    wire:model.defer="{{ $field->key }}"
/>  
@else
<x-native-select
    label="{{ $field->label }}"
    placeholder="{{ $field->placeholder }}"
    :options="$field->options"
    option-key-label="{{ $field->option_key_label }}"
    option-key-value="{{ $field->option_key_value }}"
    wire:model.defer="{{ $field->key }}"
/> 
@endif