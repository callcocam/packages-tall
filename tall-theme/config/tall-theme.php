<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
return [
    "layouts"=>[
        "app"=>env('TALL_LAYOUT_APP',"layouts.app"),
        "admin"=>env('TALL_LAYOUT_ADMIN',"tall-theme::layouts..app"),
    ],
    "date_picker"=>[
        "enableTime"=>false
    ],
    "plugins"=>[
            'app_js'        => '/js/app.js',
            'app_css'        => '/css/app.css',
            'fonts'=>[
                'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap',
                'https://cdn.linearicons.com/free/1.0.0/icon-font.min.css',
                '/css/fontawesome/css/all.css'
             ],
             'styles'=>[],
             'scripts'=>[
                 'https://raw.githack.com/CristianDavideConte/universalSmoothScroll/master/js/universalsmoothscroll-min.js',
                 '/js/assets/tall.js',
                 '/js/assets/scroll.js'
             ],
            /*
            * https://flatpickr.js.org
            */
            'flat_piker' => [
                'js'        => 'https://cdn.jsdelivr.net/npm/flatpickr',
                'css'       => 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css',
               'translate' => (app()->getLocale() != 'en') ? 'https://npmcdn.com/flatpickr/dist/l10n/' . \Illuminate\Support\Str::substr(app()->getLocale(), 0, 2) . '.js' : '',
                'locales'   => [
                    'pt_BR' => [
                        'locale'     => 'pt',
                        'dateFormat' => 'd/m/Y',
                        'enableTime' => false,
                        'time_24hr'  => true,
                    ],
                ],
            ],
        ]

];