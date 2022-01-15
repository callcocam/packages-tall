<div class="container mx-auto  rounded flex items-center justify-start">
    <div class="pl-3 text-sm breadcrumbs text-primary flex-1">
        <ul class="flex w-full space-x-3">
            <li class="flex">
                <a href="{{ route('admin') }}">
                    <i class="swfa fas fa-home ml-2" aria-hidden="true"></i>
                    <span class="ml-3">{{ __('Dashboard')}}</span>
                </a>
            </li>
            {{ $slot }}
        </ul>
    </div>
</div>