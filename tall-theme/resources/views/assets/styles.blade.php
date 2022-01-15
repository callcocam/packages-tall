<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
<!-- Fonts -->
<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
<script src="{{ config('tall-theme.plugins.universalsmoothscroll') }}">
</script>
<link rel="stylesheet" href="{{ asset(config('tall-theme.plugins.fontawesome')) }}">
<!-- Styles -->
<link rel="stylesheet" href="{{ mix(config('tall-theme.plugins.app_css')) }}"> 
@livewireStyles
@wireUiScripts
<link rel="stylesheet" href="{{ config('tall-theme.plugins.flat_piker.css') }}">
@isset($cssPath)
    <style>{!! file_get_contents($cssPath) !!}</style>
@endisset
