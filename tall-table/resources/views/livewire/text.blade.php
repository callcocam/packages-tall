<div x-data="{open: @entangle('open')}">
    <div x-show="!open" @click="open=true">
        {{ $label }}
    </div>
    <div x-show="open" @click.away="open = false" class="bg-green-200 p-1">
        <x-input placeholder="{{ $placeholder }}" wire:model.lazy="data" />
    </div>
</div>
