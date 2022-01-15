<script>
    window.onload = function () {
        if (!window.Alpine) {
            console.warn('Oops. Could not find Alpine. Are you sure you installed it? See: https://alpinejs.dev/', {
                alpine: 'https://alpinejs.dev/',
                powergrid: 'https://github.com/Power-Components/tall-theme',
            })
        } else {
            if (window.Alpine.version && /^2\..+\..+$/.test(window.Alpine.version)) {
                console.warn('Oops. Powergrid does not support V2.x', {
                    alpine: 'https://alpinejs.dev/',
                    powergrid: 'https://github.com/Power-Components/tall-theme',
                })
            }
        }
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