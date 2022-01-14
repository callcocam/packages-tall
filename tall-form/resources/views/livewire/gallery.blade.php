<div class="flex flex-col relative gap-2">
    <div class="flex flex-col relative gap-2" wire:ignore>
        @if ($fields)
            @foreach ($fields as $field)
                @include(sprintf('tall-forms::fields.%s',$field->type))
            @endforeach
        @endif
    </div>
    <x-button dark label="{{ __('Save Or Change') }}" wire:click="save" />
</div>
