<div class="grid grid-cols-4 gap-2">
    <x-button wire:click="exportToXLS" squared icon="chart-square-bar" dark label="{{ __('XSLS') }}" />
    <x-button wire:click="exportToCsv" squared icon="chart-square-bar" primary label="{{ __('CSV') }}" />
    <x-button squared icon="chart-square-bar" positive label="{{ __('PDF') }}" />
    <x-button squared icon="code" negative label="{{ __('HTML') }}" />
</div>
