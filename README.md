#TAL FORM TABLE

#ALTERANDO O MIX PARA INCLUIR o MIX DO PACOTE
```
mix
.js('resources/js/app.js', 'public/js')
.js('vendor/callcocam/packages-tall/tall-theme/resources/js/app.js', 'public/js/assets')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .postCss('vendor/callcocam/packages-tall/tall-theme/resources/css/app.css', 'public/css/assets', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .copy('resources/js/scroll.js', 'public/js/asset/scroll.js')
    .react();

if (mix.inProduction()) {
    mix.js('packages/tall-theme/resources/js/app.js', 'packages/tall-theme/resources/js/assets/tall.js');
    mix.version();
}

```

#PUBLICAR AS CONFIG

```

sail artisan vendor:publish --tag=tall-theme-config --force

```

#PUBLICAR AS VIEWS

```

sail artisan vendor:publish --tag=tall-theme-views --force

```