<x-textarea wire:model.defer="{{ $field->key }}" placeholder="{{ $field->placeholder }}" prefix="{{ $field->prefix }}"
    suffix="{{ $field->suffix }}" icon="{{ $field->icon }}"
     hint="{{ $field->hint }}"
     right-icon="{{ $field->right_icon }}"
    corner-hint="{{ $field->corner_hint }}" label="{{ $field->label }}">
    @if ($field->append)
        @include('tall-forms::fields.input-append')
    @endif
    @if ($field->prepend)
        @include('tall-forms::fields.input-prepend')
    @endif
</x-textarea>
