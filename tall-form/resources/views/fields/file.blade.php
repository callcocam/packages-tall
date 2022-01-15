<div x-data={visible:false} class="flex flex-col mt-6" @mouseout.away="visible = false" @mouseover="visible = true">
    @php
        $files = \Arr::get($model, $field->name);
    @endphp
    <div class="relative px-6 mt-4">
        @if ($files->count())
            @foreach ($files as $file)
                <span class="my-2 flex w-full justify-start text-blue-500">
                    <a class=" mr-12" href="{{ \Storage::url(\Arr::get($file, $field->attribute)) }}"
                        target="_blank" rel="noopener noreferrer">{{ \Arr::get($file, $field->attribute) }}</a>
                </span>
            @endforeach
        @endif
        <div class="file_upload p-5 relative border-4 border-dotted border-gray-300 rounded-lg w-full px-5">
            <svg class="text-indigo-500 w-16 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
            </svg>
            <div class="input_field flex flex-col w-max mx-auto text-center">
                <label>
                    <input class="text-sm cursor-pointer w-36 hidden" type="file" wire:model="{{ $field->key }}" hidden
                        x-ref="{{ $field->name }}" type="file" name="{{ $field->name }}" id="{{ $field->name }}"
                        @if ($field->multiple) multiple="true" @endif>
                    <div
                        class="text bg-indigo-600 text-white border border-gray-300 rounded font-semibold cursor-pointer p-1 px-3 hover:bg-indigo-500">
                        {{ __('Select') }}</div>
                </label>

                <div class="title text-indigo-500 uppercase">{{ __('or drop files here') }}</div>
            </div>
            <div
                class="close_btn absolute -top-11 -right-10 bg-white p-4 cursor-pointer hover:bg-gray-100 py-2 text-gray-600 rounded-full">
                X</div>
        </div>
    </div>
</div>
