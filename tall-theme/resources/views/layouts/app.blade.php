<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SIGA') }}</title>
    @tallStyles
    @tallScripts
</head>
<body class="h-screen">
    <x-dialog z-index="z-50" blur="md" align="center" />
    <x-notifications z-index="z-50" />
    @livewire('tall-theme::admin.includes.header')
    <!-- Page Content -->
    <main class="flex w-full">
        @tallLoader
        @livewire('tall-theme::admin.includes.sidebar')
        <!-- Page Heading -->
        <div class="flex-1 h-screen p-5">
            <div class="flex flex-col">
                <div class="recent-activity block">
                    @if (isset($header))
                        <div class="w-full py-2">
                            <h5 class="text-3xl py-3"> {{ $header }}</h5>
                        </div>
                    @endif
                    {{ $slot }}
                </div>
            </div>
    </main>
    @stack('modals')
    @include('tall-theme::layouts.includes.scripts')
</body>
</html>
