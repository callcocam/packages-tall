<div class="border-l-4 border-r-4 border-b-4 border-dotted border-gray-300 rounded-md p-5 ">
    <label class="flex flex-col space-y-2" for="{{ $field->name }}">
        {{ $field->label }}
        @if ($field->hint)
            <p class="pl-2 text-gray-600 text-sm">{{ $field->hint }}</p>
        @endif
    </label>
    <div class="my-2">
        <x-input id={{ $field->name }} wire:model.debounce.500ms="checkboxSearch.{{ $field->name }}"
            right-icon="search" placeholder="{{ __('Search...') }}" />
    </div>
    @forelse  ($field->options as $key => $label)
        @include('tall-forms::fields.checkbox', compact('key', 'label'))
    @empty
        @include('tall-forms::fields.checkbox', ['label' => $field->label, 'key' => 1])
    @endforelse
</div>
