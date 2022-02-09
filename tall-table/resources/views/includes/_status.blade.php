<div class="flex space-x-2">
    @if ($model->status)
        @if (is_object($model->status))
            @if ($model->status->slug == 'draft')
                <x-toggle value="{{ $model->id }}" lg wire:model.defer="status.{{ $model->id }}" />
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    {{ $model->status->name }}
                </span>
            @else
                <x-toggle value="{{ $model->id }}" lg wire:model.defer="status" />
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                    {{ $model->status->name }}
                </span>
            @endif
        @else
         {{ $model->status }}
        @endif
    @endif
</div>
