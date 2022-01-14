<x-slot name="prepend">
    <div class="absolute inset-y-0 left-0 flex items-center p-0.5">
        <x-button class="{{ $field->prepend->class }}" @if ($field->prepend->icon)
            icon="{{ $field->prepend->icon }}"
            @endif
            @if ($field->prepend->primary)
                primary
            @endif
            @if ($field->prepend->flat)
                flat
            @endif
            @if ($field->prepend->squared)
                squared
            @endif
            />
    </div>
</x-slot>