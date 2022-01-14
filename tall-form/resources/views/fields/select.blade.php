@if ($field->optionComponent)
    <x-select :label="$field->label" :placeholder="$field->placeholder" :multiselect="$field->multiselect"
        :searchable="$field->searchable" wire:model.defer="{{ $field->key }}">
        @foreach ($field->options as $key => $option)
            @if ($field->optionComponent === 'user')
                <x-select.user-option img="{{ data_get($option, $field->option_key_cover) }}"
                    label="{{ data_get($option, $field->option_label) }}"
                    value="{{ data_get($option, $field->option_value) }}" />
            @else
                <x-select.option label="{{ $option }}" value="{{ $key }}" />
            @endif
        @endforeach
    </x-select>
@else
    <x-select :label="$field->label" :placeholder="$field->placeholder" :multiselect="$field->multiselect"
        :searchable="$field->searchable" :option-label="$field->option_label" :option-value="$field->option_value"
        :option-key-label="$field->option_key_label" :option-key-value="$field->option_key_value"
        :options="$field->options" wire:model.defer="{{ $field->key }}" />
@endif
