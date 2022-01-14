<x-inputs.currency wire:model.defer="{{ $field->key }}" prefix="{{ $field->prefix }}"
    decimal="{{ $field->decimal }}" thousands="{{ $field->thousands }}" corner-hint="{{ $field->corner_hint }}"
    label="{{ $field->label }}" />
