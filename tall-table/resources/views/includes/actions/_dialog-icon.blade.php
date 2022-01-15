<x-dropdown.item x-on:confirm="{
    title: '{{ $dialog->title }}',
    description: '{{ $dialog->description }}',
    icon: '{{ $dialog->icon }}',
    method: '{{ $dialog->method }}',
    params: '{{ $dialog->params }}'
}" icon="{{ $icon }}" label="{{ __($label) }}" />