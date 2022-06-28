<div class="border-l-4 border-r-4 border-b-4 border-dotted border-gray-300 rounded-md p-5 ">
    <label class="flex flex-col space-y-2" for="{{ $field->name }}">
        {{ $field->label }}
        @if ($field->hint)
            <p class="pl-2 text-gray-600 text-sm">{{ $field->hint }}</p>
        @endif
    </label>
    <div class="my-2">
        <x-input id="{{ $field->name }}" wire:model.debounce.500ms="checkboxSearch.{{ $field->name }}"
            right-icon="search" placeholder="{{ __('Search...') }}" />
    </div>
    @foreach  ($field->options as $key => $label)
        @php
            if ($key) {
                $value = $key;
                $key = sprintf('%s.%s', $field->key, $key);
            } else {
                $value = true;
                $key = $field->key;
            }
        @endphp
        @if ($field->left_label)
            <x-checkbox :lg="$field->lg" :md="$field->md" left-label="{{ $label }}" value="{{ $value }}"
                wire:model.defer="{{ $key }}" />
        @else
            <x-checkbox value="{{ $value }}" :lg="$field->lg" :md="$field->md" label="{{ $label }}"
                wire:model.defer="{{ $key }}" />
        @endif
    @endforeach
</div>
