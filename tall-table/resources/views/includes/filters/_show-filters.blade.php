<div class="flex space-x-2 py-2 mx-5 justify-between">
    @if ($actionsHeaders)
        @include(include_table('actions._headers'))
    @endif
    <div class="flex space-x-2">
        @if ($hasFilter)
            @foreach ($makeDataFilters as $filters)
                @foreach ($filters as $name => $filter)
                    @if (is_array(data_get($filter, 'value', [])))
                        @if (array_filter(data_get($filter, 'value')))
                            <x-button wire:click="removeFilter('{{ $name }}')" rightIcon="x" xs rounded primary
                                label="{{ __(\Str::title($name)) }}" />
                        @endif
                    @elseif (data_get($filter, 'value'))
                        <x-button wire:click="removeFilter('{{ $name }}')" rightIcon="x" xs rounded primary
                            label="{{ __(\Str::title($name)) }}" />
                    @endif
                @endforeach
            @endforeach
            <x-button wire:click="removeAllFilter()" rightIcon="x" xs rounded negative
                label="{{ __('Clear All') }}" />
        @endif
    </div>
    {{-- <div class="flex items-center">
        <x-toggle lg wire:model="sortable" />   
    </div> --}}
</div>
