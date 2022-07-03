<!-- Fonts -->
@if ($fonts = config('tall-theme.plugins.fonts'))
    @foreach ($fonts as $font)
        <link href="{{ $font }}" rel="stylesheet">
    @endforeach
@endif

<script src="{{ config('tall-theme.plugins.universalsmoothscroll') }}">
</script>
<!-- Styles -->
<link rel="stylesheet" href="{{ mix(config('tall-theme.plugins.app_css')) }}">
@livewireStyles
@wireUiScripts
<link rel="stylesheet" href="{{ config('tall-theme.plugins.flat_piker.css') }}">
@if ($styles = config('tall-theme.plugins.styles'))
    @foreach ($styles as $style)
        @if (\Str::contains($style, 'http'))
            <link href="{{ $style }}" rel="stylesheet">
        @else
            <link href="{{ asset($style) }}" rel="stylesheet">
        @endif
    @endforeach
@endif
@stack("styles")