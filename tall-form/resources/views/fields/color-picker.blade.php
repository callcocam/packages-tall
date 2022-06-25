@if ($field->wire_model == 'defer')
    <x-color-picker class="w-full" wire:model.defer="{{ $field->key }}" placeholder="{{ $field->placeholder }}"
        hint="{{ $field->hint }}" corner-hint="{{ $field->corner_hint }}" label="{{ $field->label }}">
    </x-color-picker>
@endif
@if ($field->wire_model == 'lazy')
    <x-color-picker class="w-full" wire:model.lazy="{{ $field->key }}" placeholder="{{ $field->placeholder }}"
        hint="{{ $field->hint }}" corner-hint="{{ $field->corner_hint }}" label="{{ $field->label }}">
    </x-color-picker>
@endif
@if ($field->wire_model == 'model')
    <x-color-picker class="w-full" wire:model="{{ $field->key }}" placeholder="{{ $field->placeholder }}"
        hint="{{ $field->hint }}" corner-hint="{{ $field->corner_hint }}" label="{{ $field->label }}">
    </x-color-picker>
@endif
