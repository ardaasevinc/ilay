<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Admin Navigation Configuration
    |--------------------------------------------------------------------------
    |
    | Bu dosyada admin paneli için navigation ayarları tanımlanır.
    | Hiyerarşik menü yapısı için grup ve alt grup tanımları.
    |
    */

    'groups' => [
        'content' => [
            'label' => 'İçerik Yönetimi',
            'icon' => 'heroicon-o-document-duplicate',
            'sort' => 20,
            'subgroups' => [
                'blog' => [
                    'label' => 'Blog İşlemleri',
                    'icon' => 'heroicon-o-newspaper',
                    'sort' => 1,
                ],
                'pages' => [
                    'label' => 'Sayfa İşlemleri',
                    'icon' => 'heroicon-o-document-text',
                    'sort' => 2,
                ],
            ],
        ],
        'users' => [
            'label' => 'Kullanıcı & Yetki',
            'icon' => 'heroicon-o-user-group',
            'sort' => 10,
        ],
    ],

    'resources' => [
        'pages' => [
            'group' => 'content',
            'subgroup' => 'pages',
            'sort' => 1,
            'label' => 'Sayfa Yönetimi',
            'icon' => 'heroicon-o-document-text',
        ],
        'news' => [
            'group' => 'content',
            'subgroup' => 'blog',
            'sort' => 2,
            'label' => 'Blog Yönetimi',
            'icon' => 'heroicon-o-newspaper',
        ],
        'news-categories' => [
            'group' => 'content',
            'subgroup' => 'blog',
            'sort' => 3,
            'label' => 'Blog Kategori Yönetimi',
            'icon' => 'heroicon-o-tag',
        ],
        'users' => [
            'group' => 'users',
            'sort' => 1,
            'label' => 'Kullanıcı Yönetimi',
            'icon' => 'heroicon-o-users',
        ],
        'roles' => [
            'group' => 'users',
            'sort' => 2,
            'label' => 'Yetki Yönetimi',
            'icon' => 'heroicon-o-shield-check',
        ],
    ],
];
