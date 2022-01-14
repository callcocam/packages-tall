@if ($column->inputDateSelectFilter)
    @if ($column->options)
        <div class="flex flex-col space-y-1 px-2 z-40">
            <x-native-select wire:model="filters.{{ $column->inputDateSelectFilter }}.value">
                <option value>{{ __("==Select==") }}</option>
                @foreach ($column->options as $key => $value)
                    <option value="{{ $key }}">{{ __($value) }}</option>
                @endforeach
            </x-native-select>
        </div>
    @endif
@endif
