<thead class="bg-gray-50">
    <tr>
        @if ($checkbox)
            <th>

            </th>
        @endif
        @if ($columns)
            @foreach ($columns as $column)
                @if ($column->sortable)
                    <th scope="col" wire:click="sortBy('{{ $column->name }}')"
                        class=" px-6 cursor-pointer py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <div class="flex space-x-2">
                            @if ($sortField !== $column->name)
                                <x-icon name="switch-vertical" class="w-4 h-4" />
                            @elseif ($sortDirection == 'desc')
                                <x-icon name="sort-descending" class="w-4 h-4" />
                            @else
                                <x-icon name="sort-ascending" class="w-4 h-4" />
                            @endif
                            @if ($sortField === $column->name)
                                <span class="text-gray-900 font-bold">
                                    {{ $column->label }}
                                </span>
                            @else
                                <span>
                                    {{ $column->label }}
                                </span>
                            @endif

                        </div>
                    </th>
                @else
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ $column->label }}
                    </th>
                @endif
            @endforeach
        @endif
        @if ($actions)
            <th scope="col" class="relative px-6 py-3">
                <span class="sr-only">Edit</span>
            </th>
        @endif
    </tr>
    @include(include_table("_filters"))
</thead>
