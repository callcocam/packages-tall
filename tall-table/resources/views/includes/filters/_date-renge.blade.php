@if ($column->inputDatePickerFilter)
    <div class="flex flex-col space-y-1 px-2 z-40">
        <x-datetime-picker without-timezone without-tips without-time placeholder="{{ __('FROM') }}"
            parse-format="DD-MM-YYYY HH:mm" wire:model.lazy="filters.{{ $column->inputDatePickerFilter }}.start" />
        <x-datetime-picker without-tips without-time placeholder="{{ __('TO') }}" parse-format="DD-MM-YYYY HH:mm"
            wire:model.lazy="filters.{{ $column->inputDatePickerFilter }}.end" />
    </div>
@endif
