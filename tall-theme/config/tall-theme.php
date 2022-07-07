<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
return [
    "layouts"=>[
        "logo-bg"=>env('TALL_LAYOUT_LOGO_BG',"#141414"), //cor de fundo
        "logo"=>env('TALL_LAYOUT_LOGO',"img/logo-black.png"), //logo-black.png  logo.png
        "app"=>env('TALL_LAYOUT_APP',"layouts.app"),
        "admin"=>env('TALL_LAYOUT_ADMIN',"tall-theme::layouts.app"),
    ],
    "date_picker"=>[
        "enableTime"=>false
    ],
    "plugins"=>[
            'app_js'        => '/js/assets/app.js',
            'app_css'        => '/css/assets/app.css',
            'fonts'=>[
                'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap',
                'https://cdn.linearicons.com/free/1.0.0/icon-font.min.css',
                '/css/fontawesome/css/all.css'
             ],
             'styles'=>[
                'vendor/tall-editor/css/editor.css'
             ],
             'scripts'=>[
                 'https://raw.githack.com/CristianDavideConte/universalSmoothScroll/master/js/universalsmoothscroll-min.js',
                 '/js/assets/scroll.js',
                 //'https://unpkg.com/react@17/umd/react.development.js',
                 //'https://unpkg.com/react-dom@17/umd/react-dom.development.js',
                //  'vendor/tall-editor/js/editor.js',
                //  'vendor/tall-editor/js/app.js',
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
        ],
        'components'=>[
            'app'=>[
                'after'=>'app',
                'namespace'=>[
                    'App'
                ],
            ],
            'vendor/callcocam/packages-tall'=>[
                'after'=>'src',
                'namespace'=>[
                    'tall-theme'=>'Tall\\Theme',
                    'tall-tenant'=>'Tall\\Tenant',
                    'tall-acl'=>'Tall\\Acl',
                    'tall-form'=>'Tall\\Form',
                    'tall-table'=>'Tall\\Table',
                    'tall-report'=>'Tall\\Report',
                    'tall-editor'=>'Tall\\Editor',
                    'tall-schema'=>'Tall\\Schema'
                ],
            ],
            'packages-tall'=>[
                'after'=>'src',
                'namespace'=>[
                    'tall-theme'=>'Tall\\Theme',
                    'tall-tenant'=>'Tall\\Tenant',
                    'tall-acl'=>'Tall\\Acl',
                    'tall-form'=>'Tall\\Form',
                    'tall-table'=>'Tall\\Table',
                    'tall-report'=>'Tall\\Report',
                    'tall-editor'=>'Tall\\Editor',
                    'tall-schema'=>'Tall\\Schema'
                ],
            ]
        ]

];