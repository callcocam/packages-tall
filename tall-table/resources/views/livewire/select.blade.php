<div x-data="{open: @entangle('open')}" class="relative">
    <div x-show="!open" @click="open=true">
        {{ $label }}
    </div>
    <div x-show="open" @click.away="open = false" class="bg-green-200 p-1">
        <x-select   placeholder="{{ $placeholder }}" wire:model.lazy="data">           
            @if ($options)
                @foreach ($options as $value => $label)        
                    <x-select.option label="{{$label}}" value="{{$value}}" />
                @endforeach
            @endif
        </x-select>
    </div>
</div>
