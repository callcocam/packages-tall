<link rel="stylesheet" href="{{ config('tall-theme.plugins.flat_piker.css') }}">

@isset($cssPath)
    <style>{!! file_get_contents($cssPath) !!}</style>
@endisset