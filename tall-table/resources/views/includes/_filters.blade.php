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
                @include(include_table('filters._date-picker'), compact('column','theme'))
                @include(include_table('filters._date-renge'), compact('column','theme'))
                @include(include_table('filters._input-text'), compact('column','theme'))
                @include(include_table('filters._input-select'), compact('column','theme'))
            </th>
        @endforeach
    @endif
    <th class="p-2 flex items-center justify-between">
        @if ($this->isSearch())
            <x-input wire:model.debounce.500ms="search" right-icon="search" placeholder="{{ __('Search..') }}" />
        @endif
        @if (\Route::has($this->create))
            <a href="{{ route($this->create) }}"
                class="bg-green-500 text-white w-8 h-8 items-center justify-center flex">
                <x-icon name="plus" class="h-5 w-5" />
            </a>
        @endif
    </th>
</tr>
