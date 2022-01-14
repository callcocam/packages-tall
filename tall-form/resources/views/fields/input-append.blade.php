<x-slot name="append">
    <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
        <x-button class="{{ $field->append->class }}" @if ($field->append->icon)
            icon="{{ $field->append->icon }}"
            @endif
            @if ($field->append->primary)
                primary
            @endif
            @if ($field->append->flat)
                flat
            @endif
            @if ($field->append->squared)
                squared
            @endif />
    </div>
</x-slot>