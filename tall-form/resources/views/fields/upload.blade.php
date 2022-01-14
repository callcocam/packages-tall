<div x-data={visible:false} class="flex flex-col mt-2" @mouseout.away="visible = false" @mouseover="visible = true">
    <input wire:model="{{ $field->key }}" hidden x-ref="{{ $field->name }}" type="file" name="{{ $field->name }}"
        id="{{ $field->name }}">
    @php
        $image = \Arr::get($model, $field->name);
    @endphp
    <div @if (Arr::get($data, sprintf("imagens.%s", $field->name)) instanceof \Livewire\TemporaryUploadedFile)
        style="background-image: url({{ Arr::get($data, sprintf("imagens.%s", $field->name))->temporaryUrl() }});"
    @else
        style="background-image: url({{ \Storage::url(\Arr::get($image, $field->name)) }});"
        @endif
        class="relative bg-cover bg-center border-4 border-dotted border-gray-300  cursor-pointer bg-gray-100 rounded-xl shadow-md h-72 flex items-center justify-center">
        <label class="absolute cursor-pointer top-0 left-0 right-0 bottom-0 h-full w-full bg-gray-500 opacity-30"
            :class="{'invisible':!visible}" :class="{'visible':visible}" for="{{ $field->name }}">
        </label>
        <div :class="{'invisible':!visible}" :class="{'visible':visible}">
            <label class="flex flex-col items-center justify-center">
                <x-icon name="cloud-upload" class="w-16 h-16 text-gray-900" />
                <p class="text-gray-900">{{ __('Click here') }}</p>
                <p class="text-gray-900 text-3xl font-bold uppercase">{{ __($field->label) }}</p>
            </label>
        </div>
    </div>
</div>
