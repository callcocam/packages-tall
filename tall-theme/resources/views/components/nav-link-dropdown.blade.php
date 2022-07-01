@props(['active','icon'=>null])

@php
$default = " flex items-center py-2 w-full text-sm font-medium leading-5 focus:outline-none transition";
$classes = ($active ?? false)
            ? ' text-gray-900  focus:border-indigo-700'
            : ' text-gray-500 hover:text-gray-700 hover:border-gray-300  focus:text-gray-700 focus:border-gray-300';
@endphp

<li class="flex w-full">
    <a {{ $attributes->merge(['class' => \Str::of($classes)->append($default)]) }}> 
        @if ($icon)
        <x-icon name="{{ $icon }}" class="w-3 h-3 text-gray-300" /> 
       @endif
        <span class="flex">{{ $slot }}</span></a>
</li>