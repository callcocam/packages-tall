<div>
    @if ($field->label)
        <x-label>{{ $field->label }}</x-label>
    @endif
    @if ($field->wire_model == 'defer')
        <x-color-picker :colors="$field->colors" class="w-full" wire:model.defer="{{ $field->key }}"
            placeholder="{{ $field->placeholder }}" hint="{{ $field->hint }}" corner-hint="{{ $field->corner_hint }}"
            label="{{ $field->label }}" />
    @endif
    @if ($field->wire_model == 'lazy')
        <x-color-picker :colors="$field->colors" class="w-full" wire:model.lazy="{{ $field->key }}"
            placeholder="{{ $field->placeholder }}" label="{{ $field->label }}" />
    @endif
    @if ($field->wire_model == 'model')
        <x-color-picker :colors="$field->colors" class="w-full" wire:model="{{ $field->key }}"
            placeholder="{{ $field->placeholder }}" hint="{{ $field->hint }}"
            corner-hint="{{ $field->corner_hint }}" label="{{ $field->label }}" />
    @endif
</div>

