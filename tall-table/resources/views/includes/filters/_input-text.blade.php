@if ($column->inputDateTextFilter)
    <div class="flex items-center justify-start  px-2 z-40">
        <x-dropdown class="z-40" align="left" wire:model="filters.{{ $column->inputDateTextFilter }}.key">
            <x-slot name="trigger">
                <button class="rounded-l-sm border-0 text-white bg-indigo-500 flex items-center p-2">
                    <x-icon name="chevron-double-down" class="h-5 w-5 animate-pulse" />
                </button>
            </x-slot>
            @foreach ($column->inputDateTextFilterOptions as $key => $value)
                <x-dropdown.item
                    wire:click="$set('filters.{{ $column->inputDateTextFilter }}.key','{{ $key }}')"
                    icon="cog" label="{{ __($value) }}" />
            @endforeach
        </x-dropdown>
        @if ($name = \Arr::get($filters, sprintf('%s.key', $column->inputDateTextFilter)))
            <x-input class="rounded-l-sm rounded-r-none"
                wire:model.debounce.500ms="filters.{{ $column->inputDateTextFilter }}.value" right-icon="search"
                placeholder="{{ __(\Arr::get($column->inputDateTextFilterOptions, $name)) }}" />
        @endif

    </div>
@endif
