<x-inputs.phone wire:model.defer="{{ $field->key }}"
     placeholder="{{ $field->placeholder }}" 
     :mask="$field->mask"
     icon="{{ $field->icon }}"
     hint="{{ $field->hint }}"
    corner-hint="{{ $field->corner_hint }}" 
    label="{{ $field->label }}"/>
