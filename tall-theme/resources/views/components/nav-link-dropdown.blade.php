@props(['active','icon'=>null])

@php
$classes = ($active ?? false)
            ? 'py-2 w-full text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition'
            : 'py-2 w-full text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition';
@endphp

<li class="flex w-full">
    <a {{ $attributes->merge(['class' => $classes]) }}> 
        @if ($icon)
        <x-icon name="{{ $icon }}" class="w-6 h-6" /> 
       @endif
        <span class="flex">{{ $slot }}</span></a>
</li>