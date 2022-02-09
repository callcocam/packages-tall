<div x-data="{open: @entangle('open')}" class="relative">
    @if ($model->status)
        @if (is_object($model->status))
            <div x-show="!open" @click="open=true">
                @if ($model->status->slug == 'draft')
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                        {{ $label }}
                    </span>
                @else
                    <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        {{ $label }}
                    </span>
                @endif
            </div>
            <div x-show="open" @click.away="open = false" class="bg-green-200 p-1">
                <x-native-select placeholder="{{ $placeholder }}" wire:model.lazy="data">
                    @if ($options)
                        @foreach ($options as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    @endif
                </x-native-select>
            </div>
        @endif
    @else
        {{ $model->status }}
    @endif
</div>
