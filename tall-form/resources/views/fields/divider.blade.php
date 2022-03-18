<div class="bg-white rounded p-4 px-4 md:p-2 mb-2  border-t-2">
    <div class="text-sm ">
        <div class="text-gray-600 flex flex-col space-y-1">
            <p class="font-medium text-lg">{{ $field->label }}</p>
            @if ($field->hint)
                <p>{{ $field->hint }}</p>
            @endif
        </div>
    </div>
</div>
