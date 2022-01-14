@if ($column->inputDateTextFilter)
    <div class="flex flex-col space-y-1 px-2 z-40">
        <x-native-select wire:model="filters.{{ $column->inputDateTextFilter }}.key">
           @foreach ($column->inputDateTextFilterOptions as $key=>$value)               
            <option value="{{ $key }}">{{ __($value) }}</option>
           @endforeach            
        </x-native-select>
        <x-input wire:model.debounce.500ms="filters.{{ $column->inputDateTextFilter }}.value" right-icon="search"
            placeholder="{{ __('Search..') }}" />
    </div>
@endif
