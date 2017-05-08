<?php

return [
	'name' => 'Frontend',
    'filter' => [
        'auth' => [
            Modules\Frontend\Http\Middleware\Authenticate::class,
        ],
        'frontend_guest' => Modules\Frontend\Http\Middleware\RedirectIfAuthenticated::class,
    ],
	'contact' => [
			'model' => 'Modules\Frontend\Entities\Contact',
			'perpage' => 10
	],
	'news' => [
			'model' => 'Modules\Frontend\Entities\News',
			'perpage' => 10
	]
];