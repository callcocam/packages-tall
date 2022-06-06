<div class="flex flex-col mt-1">
    @php
        $file = \Arr::get($model, $field->name);
    @endphp
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
        for="{{ $field->name }}">{{ __($field->label) }}</label>
    <input
        class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
        wire:model="{{ $field->key }}" name="{{ $field->name }}" id="{{ $field->name }}" type="file">
    <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">
        @if ($file)
            @if(is_string($file))
            <a class=" mr-12" href="{{ \Storage::url($file) }}" target="_blank"
                rel="noopener noreferrer">{{ $file }}</a>
        @else
            <a class=" mr-12" href="{{ \Storage::url($file->url) }}" target="_blank"
                rel="noopener noreferrer">{{ $file->url }}</a>
        @endif
        @endif
    </div>
    <span class="my-2 flex w-full justify-start text-blue-500"></span>
</div>