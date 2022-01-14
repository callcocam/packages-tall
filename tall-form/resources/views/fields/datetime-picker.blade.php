<x-datetime-picker
    label="{{ $field->label }}"
    placeholder="{{ $field->placeholder }}"
    without-tips="{{ $field->withoutTips }}"
    without-time="{{ $field->withoutTime }}"
    without-timezone="{{ $field->withoutTimezone }}"
    display-format="{{ $field->parse_format }}"
    wire:model.defer="{{ $field->key }}"
    class="z-50"
/>