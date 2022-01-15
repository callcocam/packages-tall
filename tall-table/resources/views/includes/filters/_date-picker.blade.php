@if ($column->inputDatePickerFilter)
    @php
        $tableName = \Illuminate\Support\Str::kebab($theme->name);
        $customConfig = [];
        if (data_get($column, 'config')) {
            foreach (data_get($column, 'config') as $key => $value) {
                $customConfig[$key] = $value;
            }
        }
    @endphp

    <div wire:ignore x-data="tallFlatPickr({
        dataField: '{{ $column->inputDatePickerFilter }}',
        tableName: '{{ $tableName }}',
        filterKey: 'enabledFilters.date_picker.{{ $column->inputDatePickerFilter }}',
        label: '{{ $column->label }}',
        locale: {{ json_encode(config('tall-theme.plugins.flat_piker.locales.' . app()->getLocale())) }},
        onlyFuture: {{ json_encode(data_get($customConfig, 'only_future', false)) }},
        noWeekEnds: {{ json_encode(data_get($customConfig, 'no_weekends', false)) }},
        customConfig: {{ json_encode($customConfig) }}
    })">
        <div class="{{ $theme->filterDatePicker->divClassNotInline }}" @if ($column->inline))  @endif>
            <input id="input_{{ $column->inputDatePickerFilter }}" x-ref="rangeInput"
                data-field="{{ $column->inputDatePickerFilter }}" style="{{ $column->headerStyle }}"
                class="{{ $theme->filterDatePicker->inputClass }} {{ $column->headerClass }}" type="text"
                placeholder="00/00/00 até 00/00/0000"
                wire:model="filters.{{ $column->inputDatePickerFilter }}">
        </div>
    </div>
@endif
