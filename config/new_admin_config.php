<?php

return [
    'prefix' => 'admin',
    'filter' => [
        'auth' => [
            Pingpong\Admin\Middleware\Authenticate::class,
            Pingpong\Admin\Middleware\OnlyAdmin::class
        ],
        'guest' => Pingpong\Admin\Middleware\RedirectIfAuthenticated::class,
    ],
    'article' => [
        'model' => 'Modules\Admin\Entities\AdminArticle',
        'perpage' => 10
    ],
    'tag' => [
        'model' => 'Modules\Admin\Entities\Tag',
        'perpage' => 10
    ],
    'articleTag' => [
        'model' => 'Modules\Admin\Entities\ArticleTag',
        'perpage' => 10
    ]
];
