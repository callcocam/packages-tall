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
                'api'=>[
                    'uploads'=>[
                        'images'=>'tall-editor.api.uploads.images'
                    ]
                ]
            ]
        ],
        "blocks"=>[
            "Text category"=>[
                "core/paragraph"=>[
                    "label"=>"Paragraph",
                    "active"=>true,
                ],
                "core/heading"=>[
                    "label"=>"Heading",
                    "active"=>true,
                ],
                "core/list"=>[
                    "label"=>"List",
                    "active"=>true,
                ],
                "core/preformatted"=>[
                    "label"=>"Preformatted",
                    "active"=>true,
                ],
                "core/pullquote"=>[
                    "label"=>"Pullquote",
                    "active"=>true,
                ],
                "core/table"=>[
                    "label"=>"Table",
                    "active"=>true,
                ],
                "core/verse"=>[
                    "label"=>"Verse",
                    "active"=>true,
                ],
            ],
            "Media category"=>[
                "core/image"=>[
                    "label"=>"Image",
                    "active"=>true,
                ],
                "core/gallery"=>[
                    "label"=>"Gallery",
                    "active"=>true,
                ],
                "core/audio"=>[
                    "label"=>"Audio",
                    "active"=>true,
                ],
                "core/cover"=>[
                    "label"=>"Cover",
                    "active"=>true,
                ],
                "core/file"=>[
                    "label"=>"File",
                    "active"=>true,
                ],
                "core/media-text"=>[
                    "label"=>"Media & Text",
                    "active"=>true,
                ],
                "core/video"=>[
                    "label"=>"Video",
                    "active"=>false,
                ],
            ],
            "Design category"=>[
                "core/buttons"=>[
                    "label"=>"Buttons",
                    "active"=>true,
                ],
                "core/columns"=>[
                    "label"=>"Columns",
                    "active"=>true,
                ],
                "core/group"=>[
                    "label"=>"Group",
                    "active"=>true,
                ],
                "core/row"=>[
                    "label"=>"Row",
                    "active"=>true,
                ],
                "core/stack"=>[
                    "label"=>"Stack",
                    "active"=>true,
                ],
                "core/more"=>[
                    "label"=>"More",
                    "active"=>true,
                ],
                "core/nextpage"=>[
                    "label"=>"Page Break",
                    "active"=>true,
                ],
                "core/separator"=>[
                    "label"=>"Separator",
                    "active"=>true,
                ],
                "core/spacer"=>[
                    "label"=>"Spacer",
                    "active"=>true,
                ],
            ],
            "Widgets category"=>[
                "core/archives"=>[
                    "label"=>"Archive",
                    "active"=>true,
                ],
                "core/calendar"=>[
                    "label"=>"Calendar",
                    "active"=>false,
                ],
                "core/categories"=>[
                    "label"=>"Categories",
                    "active"=>true,
                ],
                "core/html"=>[
                    "label"=>"Custom HTML",
                    "active"=>true,
                ],
                "core/latest-comments"=>[
                    "label"=>"Latest Comments",
                    "active"=>true,
                ],
                "core/latest-posts"=>[
                    "label"=>"Latest Posts",
                    "active"=>true,
                ],
                "core/page-list"=>[
                    "label"=>"Page List",
                    "active"=>true,
                ],
                "core/rss"=>[
                    "label"=>"RSS",
                    "active"=>false,
                ],
                "core/search"=>[
                    "label"=>"Search",
                    "active"=>false,
                ],
                "core/shortcode"=>[
                    "label"=>"Shortcode",
                    "active"=>true,
                ],
                "core/social-links"=>[
                    "label"=>"Social Icons",
                    "active"=>true,
                ],
                "core/tag-cloud"=>[
                    "label"=>"Tag Cloud",
                    "active"=>true,
                ],
            ],
            "Theme category"=>[
                "core/navigation"=>[
                    "label"=>"Navigation",
                    "active"=>true,
                ],
                "core/site-logo"=>[
                    "label"=>"Site Logo",
                    "active"=>true,
                ],
                "core/site-title"=>[
                    "label"=>"Site Title",
                    "active"=>true,
                ],
                "core/site-tagline"=>[
                    "label"=>"Site Tagline",
                    "active"=>true,
                ],
                "core/query"=>[
                    "label"=>"Query Loop",
                    "active"=>true,
                ],
                "core/posts-list"=>[
                    "label"=>"Posts List",
                    "active"=>true,
                ],
                "core/avatar"=>[
                    "label"=>"Avatar",
                    "active"=>true,
                ],
                "core/post-title"=>[
                    "label"=>"Post Title",
                    "active"=>true,
                ],
                "core/post-excerpt"=>[
                    "label"=>"Post Excerpt",
                    "active"=>true,
                ],
                "core/post-featured-image"=>[
                    "label"=>"Post Featured Image",
                    "active"=>true,
                ],
                "core/post-content"=>[
                    "label"=>"Post Content",
                    "active"=>true,
                ],
                "core/post-author"=>[
                    "label"=>"Post Author",
                    "active"=>true,
                ],
                "core/post-date"=>[
                    "label"=>"Post Date",
                    "active"=>true,
                ],
                "core/post-terms"=>[
                    "label"=>"Post Categories,",
                    "active"=>false,
                ],
            ],
            "Post Tags"=>[
                "core/post-navigation-link"=>[
                    "label"=>"Next post",
                    "active"=>true,
                ],
            ],
            "Previous post"=>[
                "core/read-more"=>[
                    "label"=>"Read More",
                    "active"=>true,
                ],
                "core/comments-query-loop"=>[
                    "label"=>"Comments Query Loop",
                    "active"=>true,
                ],
                "core/post-comments-form"=>[
                    "label"=>"Post Comments Form",
                    "active"=>true,
                ],
                "core/loginout"=>[
                    "label"=>"Login/out",
                    "active"=>false,
                ],
                "core/term-description"=>[
                    "label"=>"Term Description",
                    "active"=>true,
                ],
                "core/query-title"=>[
                    "label"=>"Archive Title",
                    "active"=>true,
                ],
                "core/post-author-biography"=>[
                    "label"=>"Post Author Biography",
                    "active"=>true,
                ],
            ],
            "Embeds category"=>[
                "core/embed"=>[
                    "label"=>"Embed",
                    "active"=>false,
                ]
            ]
        ]
];