<script>
window.onload = function () {
    
}
</script>
@if(filled(config('tall-theme.plugins.flat_piker.js')))
    <script src="{{ config('tall-theme.plugins.flat_piker.js') }}"></script>
@endif
@if(filled(config('tall-theme.plugins.flat_piker.tall')))
    <script src="{{ config('tall-theme.plugins.flat_piker.tall') }}"></script>
@endif
@if(filled(config('tall-theme.plugins.flat_piker.translate')))
    <script src="{{ config('tall-theme.plugins.flat_piker.translate') }}"></script>
@endif
@if(filled(config('tall-theme.alpinejs_cdn')))
    <script src="{{ config('tall-theme.alpinejs_cdn') }}" defer></script>
@endif
@isset($jsPath)
    <script>{!! file_get_contents($jsPath) !!}</script>
@endisset
<!-- Scripts -->
<script src="{{ asset(config('tall-theme.plugins.app_js')) }}" defer></script>
<script src="{{ asset(config('tall-theme.plugins.scroll')) }}"></script>
<script src="{{ asset(config('tall-theme.plugins.tall')) }}"></script>
@livewireScripts    