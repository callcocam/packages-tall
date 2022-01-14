<div class="border-4 border-dotted border-gray-300 rounded-md p-5  mt-3">
    <div class="my-2">
        <x-input wire:model.debounce.500ms="checkboxSearch.{{ $field->name }}" right-icon="search"
            placeholder="{{ __('Search...') }}" />
    </div>
    @forelse  ($field->options as $key => $label )
        @include('tall-forms::fields.checkbox', compact('key','label'))
    @empty
        @include('tall-forms::fields.checkbox',['label'=>$field->label, 'key'=>1])
    @endforelse
</div>
