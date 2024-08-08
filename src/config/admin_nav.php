<?php

return [
    [
        'label' => 'CMS',
        'icon' => '',
        'items' => [
            'index' => [
                'label' => 'admin.nav.index',
                'icon' => 'home',
                'route_name' => 'admin.dashboard',
            ],
            'const_field' => [
                'label' => 'admin.const_field.plural',
                'icon' => 'anchor',
                'route_name' => 'admin.const_field.index',
            ],
            'nav_item' => [
                'label' => 'admin.nav_item.plural',
                'icon' => 'menu',
                'route_name' => '',
                'items' => [
                    'nav_item_main' => [
                        'label' => 'admin.navs.main',
                        'icon' => 'arrow-up-left',
                        'route_name' => 'admin.nav_item.index',
                        'params' => 'main'
                    ],
//                    'nav_item_footer' => [
//                        'label' => 'admin.navs.footer',
//                        'icon' => 'arrow-up-left',
//                        'route_name' => 'admin.nav_item.index',
//                        'params' => 'footer'
//                    ],
                ]
            ],
            'page' => [
                'label' => 'admin.page.plural',
                'icon' => 'file',
                'route_name' => 'admin.page.index',
            ],
            'rotator' => [
                'label' => 'Rotator/Slider',
                'icon' => 'sliders',
                'route_name' => 'admin.rotator.index',
            ],
            'article' => [
                'label' => 'admin.article.plural',
                'icon' => 'book',
                'route_name' => '',
                'items' => [
                    'article' => [
                        'label' => 'admin.article.plural',
                        'icon' => 'arrow-up-left',
                        'route_name' => 'admin.article.index',
                    ],
                    'article_category' => [
                        'label' => 'admin.article_category.plural',
                        'icon' => 'arrow-up-left',
                        'route_name' => 'admin.article_category.index',
                    ],
                ]
            ],
            'offer' => [
                'label' => 'admin.offer.plural',
                'icon' => 'database',
                'route_name' => '',
                'items' => [
                    'offer' => [
                        'label' => 'admin.offer.plural',
                        'icon' => 'arrow-up-left',
                        'route_name' => 'admin.offer.index',
                    ],
                    'offer_category' => [
                        'label' => 'admin.offer_category.plural',
                        'icon' => 'arrow-up-left',
                        'route_name' => 'admin.offer_category.index',
                    ],
                ]
            ],
            'realization' => [
                'label' => 'admin.realization.plural',
                'icon' => 'bookmark',
                'route_name' => '',
                'items' => [
                    'realization' => [
                        'label' => 'admin.realization.plural',
                        'icon' => 'arrow-up-left',
                        'route_name' => 'admin.realization.index',
                    ],
                    'realization_category' => [
                        'label' => 'admin.realization_category.plural',
                        'icon' => 'arrow-up-left',
                        'route_name' => 'admin.realization_category.index',
                    ],
                ]
            ],
        ]
    ],
    [
        'label' => 'admin.nav.label.settings',
        'icon' => '',
        'items' => [
            'settings' => [
                'label' => 'admin.nav.settings',
                'icon' => 'settings',
                'route_name' => '',
                'items' => [
                    'site_lang' => [
                        'label' => 'admin.site_lang.plural',
                        'icon' => 'flag',
                        'route_name' => 'admin.site_lang.index',
                    ],
                    'smtp_settings' => [
                        'label' => 'admin.smtp_settings.plural',
                        'icon' => 'mail',
                        'route_name' => 'admin.smtp_settings.edit',
                    ],
                    'google_app_settings' => [
                        'label' => 'admin.google_app_settings.plural',
                        'icon' => 'command',
                        'route_name' => 'admin.google_app_settings.edit',
                    ],
                ],
            ],
        ]
    ],
];
