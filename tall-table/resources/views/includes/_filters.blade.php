<tr class="p-2 flex-1 w-full">
    @if ($checkbox)
        <th>
            <div class="flex px-2 space-x-2 align-middle">
                <x-toggle wire:click="selectCheckboxAll()" wire:model.defer="checkboxAll" lg />
            </div>
        </th>
    @endif
    @if ($columns)
        @foreach ($columns as $column)
            <th>
                @include(include_table('filters._date-renge'))
                @include(include_table('filters._input-text'))
                @include(include_table('filters._input-select'))
            </th>
        @endforeach
    @endif
    @if ($this->isSearch())
        <th class="p-2">
            <x-input wire:model.debounce.500ms="search" right-icon="search" placeholder="{{ __('Search..') }}" />
        </th>
    @endif
</tr>
