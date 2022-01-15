@props(['active','icon'=>null])

@php
$classes = ($active ?? false)
            ? 'w-full flex space-x-2 items-center transition-colors ease-in-out duration-500 h-full px-4 py-3 focus:outline-none focus:border-indigo-700 transition'
            : 'w-full flex space-x-2 items-center transition-colors ease-in-out duration-500 h-full px-4 py-3 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition';
@endphp

<li class="w-full flex flex-col justify-end hover:bg-gray-50">
    <a {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon)
         <x-icon name="{{ $icon }}" class="w-6 h-6" /> 
        @endif
        <span class="flex">{{ $slot }}</span>
    </a>
</li>