@props(['label', 'active','icon'=>null])
<li x-data="dropdown('{{$active}}')" {{ $attributes->merge(['class' => 'w-full flex flex-col justify-end hover:bg-gray-50']) }}>
    <a x-on:click="toggle"
        class="w-full flex space-x-2 items-center transition-colors ease-in-out duration-500 h-full px-4 py-3 relative"
        href="#">
        @if ($icon)
        <x-icon name="{{ $icon }}" class="w-6 h-6" /> 
       @endif
        <span class="flex uppercase">{{ __($label) }}</span>
        <span class="transition-all duration-500 ease-in-out transform absolute right-2" :class="{ 'rotate-180': open }">
            <svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                    d="M17,9.17a1,1,0,0,0-1.41,0L12,12.71,8.46,9.17a1,1,0,0,0-1.41,0,1,1,0,0,0,0,1.42l4.24,4.24a1,1,0,0,0,1.42,0L17,10.59A1,1,0,0,0,17,9.17Z" />
            </svg>
        </span>
    </a>
    <ul x-ref="dropdownContainer"
        x-bind:style="open ? 'max-height: ' + $refs.dropdownContainer.scrollHeight + 'px' : ''"
        class="overflow-y-hidden  max-h-0 transition-all ease-in-out duration-500  ml-10 px-2">
        {{ $slot }}
    </ul>
</li>
@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('dropdown', (open) => ({
                open:open ,
                init(){
                    console.log(@entangle($attributes->get('active')))
                },
                toggle() {
                    this.open = !this.open
                },
            }))
        })
    </script>
@endpush
