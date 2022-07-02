@props(['active'=>false,'icon'=>null])

<li {{ $attributes->merge(['class' => ($active ?? false)? 'w-full flex flex-col justify-end hover:text-gray-700 hover:border-gray-500 focus:text-gray-700 focus:border-gray-300  bg-gray-200 hover:bg-gray-300':'w-full flex flex-col justify-end hover:bg-gray-300']) }}
>
    <a {{ $attributes->class('w-full flex space-x-2 items-center transition-colors ease-in-out duration-500 h-full px-4 py-3 focus:outline-none transition') }}>
        @if ($icon)
         <x-icon name="{{ $icon }}" class="w-5 h-5" /> 
        @endif
        <span class="flex uppercase">{{ $slot }}</span>
    </a>
</li>