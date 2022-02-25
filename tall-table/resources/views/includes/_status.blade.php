<div class="flex space-x-2">
    @if ($model->status)
        @if (is_object($model->status))
        <x-toggle value="{{ $model->id }}" lg wire:model.defer="status.{{ $model->id }}" />
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $model->styles }}-100 text-{{ $model->styles }}-800">
                {{ $model->status->name }}
            </span>
        @else
         {{ $model->status }}
        @endif
    @endif
</div>
