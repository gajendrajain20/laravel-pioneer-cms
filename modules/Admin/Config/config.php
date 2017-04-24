<?php

return [
    'prefix' => 'admin',
    'filter' => [
        'auth' => [
           \Modules\Admin\Middleware\AuthenticateUser::class,
        ],
        'guest' =>\App\Http\Middleware\RedirectIfAuthenticated::class
    ],
    'adminArticle' => [
        'model' => 'Modules\Admin\Entities\AdminArticle',
        'perpage' => 10
    ],
    'tag' => [
        'model' => 'Modules\Admin\Entities\Tag',
        'perpage' => 10
    ],
    'widgetposition' => [
        'model' => 'Modules\Admin\Entities\WidgetPosition',
        'perpage' => 10
    ],
    'menutype' => [
        'model' => 'Modules\Admin\Entities\MenuType',
        'perpage' => 10
    ],
    'articleTag' => [
        'model' => 'Modules\Admin\Entities\ArticleTag',
        'perpage' => 10
    ],
    'video' => [
        'model' => 'Modules\Admin\Entities\Video',
        'perpage' => 10
    ],
    'menu' => [
        'model' => 'Modules\Admin\Entities\Menu',
        'perpage' => 10
    ],
    'widget' => [
        'model' => 'Modules\Admin\Entities\Widget',
        'perpage' => 10
    ],
	'widgetMenu' => [
			'model' => 'Modules\Admin\Entities\WidgetMenu',
			'perpage' => 10
	],
	'articleCategory' => [
			'model' => 'Modules\Admin\Entities\ArticleCategory',
			'perpage' => 10
    ],
	'template' => [
			'model' => 'Modules\Admin\Entities\Template',
			'perpage' => 10
	],
	'module' => [
			'model' => 'Modules\Admin\Entities\Module',
			'perpage' => 10
	],
];
