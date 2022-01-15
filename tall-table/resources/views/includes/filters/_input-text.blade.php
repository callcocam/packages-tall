@if ($column->inputDateTextFilter)
    <div class="flex items-center justify-start space-x-1 px-2 z-40">
        <x-dropdown  align="left" wire:model="filters.{{ $column->inputDateTextFilter }}.key">
            <x-slot name="trigger">
                <x-button label="{{ $column->label }}" primary />
            </x-slot>
            @foreach ($column->inputDateTextFilterOptions as $key=>$value) 
            <x-dropdown.item wire:click="$set('filters.{{ $column->inputDateTextFilter }}.key','{{ $key }}')" icon="cog" label="{{ __($value) }}" />
            @endforeach     
        </x-dropdown> 
        <x-input wire:model.debounce.500ms="filters.{{ $column->inputDateTextFilter }}.value" right-icon="search"
            placeholder="{{ __('Search..') }}" />
    </div>
@endif
