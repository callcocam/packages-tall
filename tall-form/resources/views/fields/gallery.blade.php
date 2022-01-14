<div class="bg-white p7 rounded w-full">
    <div x-data="dataFileDnD()" class="relative flex flex-col p-4 text-gray-400 border border-gray-200 rounded">
        <div class="grid grid-cols-4 gap-2 mb-4">
            <div class="col-span-4 md:col-span-3">
                @if ($fieldTitle = $field->title)
                    @include(sprintf('tall-forms::fields.%s',$fieldTitle->type),['field'=>$fieldTitle])
                @endif
            </div>
            <div class="col-span-4 md:col-span-1">
                @if ($fieldOrdering = $field->ordering)
                    @include(sprintf('tall-forms::fields.%s',$fieldOrdering->type),['field'=>$fieldOrdering])
                @endif
            </div>
        </div>
        <div x-ref="dnd"
            class="relative flex flex-col text-gray-400 border border-gray-200 border-dashed rounded cursor-pointer">
            <input accept="*" type="file" multiple wire:model="{{ $field->key }}"
                class="absolute inset-0 z-50 w-full h-full p-0 m-0 outline-none opacity-0 cursor-pointer"
                {{-- x-on:change="addFiles($event)" --}} x-on:dragover="dragover($event)" x-on:dragleave="dragleave($event)"
                x-on:drop="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
                title="" />

            <div class="flex flex-col items-center justify-center py-10 text-center">
                <svg class="w-6 h-6 mr-1 text-current-50" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p class="m-0">Drag your files here or click in this area.</p>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 mt-4 md:grid-cols-4" x-on:drop.prevent="drop($event)"
            x-on:dragover.prevent="$event.dataTransfer.dropEffect = 'move'">
            @if ($filesArray = \Arr::get($data, $field->attribute))
                @foreach ($filesArray as $index => $filefilesArray)
                    @include(form_fields('templates.block'))
                @endforeach
            @endif
        </div>
        @if ($fieldDescription = $field->description)
            <div class="my-4">
                @include(sprintf('tall-forms::fields.%s',$fieldDescription->type),['field'=>$fieldDescription])
            </div>
        @endif
    </div>
</div>
<script>
    function dataFileDnD() {
        return {
            files: [],
            fileDragging: null,
            fileDropping: null,
            remove(fileDragging) {
                this.$wire.call('removeGalleriesItem', fileDragging, '{{ $field->attribute }}')
            },
            drop(e) {
                this.$wire.call('ordemGalleries', this.fileDropping, this.fileDragging, '{{ $field->attribute }}')
                this.fileDropping = null;
                this.fileDragging = null;
            },
            dragenter(e, index) {
                console.log(e, index, 'dragenter')
                let targetElem = e.target.closest("[draggable]");
                this.fileDropping = targetElem.getAttribute("data-index");
            },
            dragstart(e, index) {
                this.fileDragging = e.target.closest("[draggable]").getAttribute("data-index");
                e.dataTransfer.effectAllowed = "move";
            },
            dragover(e) {
                this.$refs.dnd.classList.add('border-blue-400');
                this.$refs.dnd.classList.add('ring-4');
                this.$refs.dnd.classList.add('ring-inset');
            },
            dragleave(e) {
                this.$refs.dnd.classList.remove('border-blue-400');
                this.$refs.dnd.classList.remove('ring-4');
                this.$refs.dnd.classList.remove('ring-inset');
            }
        };
    }
</script>
