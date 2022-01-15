<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
return [
    "date_picker"=>[
        "enableTime"=>false
    ],
    "plugins"=>[
            'app_js'        => '/js/app.js',
            'app_css'        => '/css/app.css',
            'tall'        => '/js/assets/tall.js',
            'scroll'        => '/js/assets/scroll.js',
            'fontawesome'        => '/css/fontawesome/css/all.css',
            'universalsmoothscroll'       => 'https://raw.githack.com/CristianDavideConte/universalSmoothScroll/master/js/universalsmoothscroll-min.js',
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
                        'dateFormat' => 'd/m/Y H:i',
                        'enableTime' => true,
                        'time_24hr'  => true,
                    ],
                ],
            ],
        ]

];