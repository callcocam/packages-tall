<div>
    <div class="relative flex flex-col items-center overflow-hidden text-center bg-gray-100 border rounded cursor-move select-none"
        draggable="true" style="padding-top: 100%;" x-on:dragstart="dragstart($event,'{{ $index }}')"
        x-on:dragend="fileDragging = null" :class="{'border-blue-600': fileDragging == {{ $index }}}"
        :data-index="{{ $index }}">
        <button class="absolute top-0 right-0 z-50 p-1 bg-white rounded-bl focus:outline-none" type="button"
            x-on:click="remove('{{ $index }}')">
            <svg class="w-4 h-4 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </button>
        @if (\Arr::get($filefilesArray, 'mime_type') == 'audio')
            @include(form_fields('templates.audio'))
        @elseif (\Arr::get($filefilesArray, 'mime_type') == 'application')
            @include(form_fields('templates.application'))
        @elseif (\Arr::get($filefilesArray, 'mime_type') == 'video')
            @include(form_fields('templates.video'))
        @else
            @include(form_fields('templates.image'))
        @endif
        <div class="absolute bottom-0 left-0 right-0 flex flex-col p-2 text-xs bg-white bg-opacity-50">
            <span
                class="w-full font-bold text-gray-900 truncate">{{ \Arr::get($filefilesArray, 'name', 'Loandig') }}</span>
            <span class="text-xs text-gray-900">{{ \Arr::get($filefilesArray, 'size', '...') }}</span>
        </div>
        <div class="absolute inset-0 z-40 transition-colors duration-300"
            x-on:dragenter="dragenter($event,' {{ $index }}')" x-on:dragleave="fileDropping = null"
            :class="{'bg-blue-200 bg-opacity-80': fileDropping == {{ $index }} && fileDragging != {{ $index }}}">
        </div>
    </div>
    @if ($galleryId = \Arr::get($filefilesArray, 'id'))
        <div class="flex flex-col w-full relative gap-2">
            @if ($array_fields = $field->array_fields)
                @livewire('tall-gallery', ["models"=>\Arr::get($model, $field->name),"fields"=>$array_fields,"value"=>$galleryId ], key($galleryId))
            @endif
        </div>
    @endif
</div>
