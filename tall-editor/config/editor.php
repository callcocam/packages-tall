<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

return [
     /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    */

    'use_package_routes' => true,
    'prefix' => 'editor',

    /*
    |--------------------------------------------------------------------------
    | Embed settings
    |--------------------------------------------------------------------------
    */
    'embed' => [
        'maxwidth' => 1200,
        'maxheight' => 1200,

        'cache' => [
            'enabled' => true,
            'duration' => 86400
        ]
        ],
        'routes'=>[
            'editors'=>[
                'list'=>'tall-acl.admin.editors',
                'create'=>'tall-acl.admin.editor.create',
                'edit'=>'tall-acl.admin.editor.edit',
                'show'=>'tall-acl.admin.editor.show',
            ]
        ]
];