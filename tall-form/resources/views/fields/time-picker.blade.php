<x-time-picker
    label="{{ $field->label }}"
    placeholder="{{ $field->placeholder }}"
    format="{{ $field->format }}"
    interval="{{ $field->interval }}"
    wire:model.defer="{{ $field->key }}"
/>