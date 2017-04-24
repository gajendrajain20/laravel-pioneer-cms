<?php
Route::group(['prefix' => config('admin.prefix', 'admin')], function () {
    
    Route::group(['middleware' => 'guest', 'namespace' => 'Pingpong\Admin\Controllers'], function () {
        Route::resource('login', 'LoginController', [
            'only' => ['index', 'store'],
            'names' => [
                'index' => 'admin.login.index',
                'store' => 'admin.login.store',
            ],
        ]);
    });
    
    Route::group(['middleware' => config('admin.filter.auth')], function () {
       
        Route::group(['namespace' => 'Pingpong\Admin\Controllers'], function () {
            Route::get('/dashboard', ['as' => 'admin.home', 'uses' => 'SiteController@index']);
            Route::get('/logout', ['as' => 'admin.logout', 'uses' => 'SiteController@logout']);
    });
        
        	
        // settings
        Route::group(['namespace' => 'Modules\Admin\Http\Controllers'], function () {
            Route::get('backup', 'BackupController@index')->name('admin.backup');
            Route::get('backup/create', 'BackupController@create')->name('admin.create');
            Route::get('backup/download/{file_name?}', 'BackupController@download')->name('admin.download');
            Route::delete('backup/delete/{file_name?}', 'BackupController@delete')->name('admin.delete');
            Route::get('settings', ['as' => 'admin.settings', 'uses' => 'SitesController@settings']);
            Route::get('categoryImport', ['as' => 'admin.dataimport', 'uses' => 'SitesController@categoryImport']);
            Route::get('articleImport', ['as' => 'admin.dataimport', 'uses' => 'SitesController@articleImport']);
            Route::get('videoImport', ['as' => 'admin.dataimport', 'uses' => 'SitesController@videoImport']);
            Route::get('userImport', ['as' => 'admin.userImport', 'uses' => 'SitesController@userImport']);
            Route::post('settings', ['as' => 'admin.settings.update', 'uses' => 'SitesController@updateSettings']);
				
            
            Route::get('template/apply/{id}', ['as' => 'admin.templates.apply', 'uses' => 'TemplatesController@apply']);
            Route::get('template/deactivate', ['as' => 'admin.templates.deactivate', 'uses' => 'TemplatesController@deactivate']);
            Route::resource('templates', 'TemplatesController', [
            		'except' => 'show',
            		'names' => [
            				'index' => 'admin.templates.index',
            				'create' => 'admin.templates.create',
            				'store' => 'admin.templates.store',
            				'show' => 'admin.templates.show',
            				'update' => 'admin.templates.update',
            				'edit' => 'admin.templates.edit',
            				'destroy' => 'admin.templates.destroy',
            		],
            ]);
            
            
            
            Route::get('modules/apply/{id}', ['as' => 'admin.modules.apply', 'uses' => 'ModulesController@apply']);
            Route::get('modules/deactivate/{id}', ['as' => 'admin.modules.deactivate', 'uses' => 'ModulesController@deactivate']);
            Route::post('modules/createModule', ['as' => 'admin.modules.createModule', 'uses' => 'ModulesController@createModule']);
            
            Route::resource('modules', 'ModulesController', [
            		'except' => 'show',
            		'names' => [
            				'index' => 'admin.modules.index',
            				'create' => 'admin.modules.create',
            				'store' => 'admin.modules.store',
            				'show' => 'admin.modules.show',
            				'update' => 'admin.modules.update',
            				'edit' => 'admin.modules.edit',
            				'destroy' => 'admin.modules.destroy',
            		],
            ]);
            
            Route::resource('categories', 'AdminCategoriesController', [
                'except' => 'show',
                'names' => [
                    'index' => 'admin.categories.index',
                    'create' => 'admin.categories.create',
                    'store' => 'admin.categories.store',
                    'show' => 'admin.categories.show',
                    'update' => 'admin.categories.update',
                    'edit' => 'admin.categories.edit',
                    'destroy' => 'admin.categories.destroy',
                ],
            ]);
            
            //widget-positions
            Route::resource('positions', 'WidgetPositionController', [
            		'except' => 'show',
            		'names' => [
            				'index' => 'admin.positions.index',
            				'create' => 'admin.positions.create',
            				'store' => 'admin.positions.store',
            				'show' => 'admin.positions.show',
            				'update' => 'admin.positions.update',
            				'edit' => 'admin.positions.edit',
            				'destroy' => 'admin.positions.destroy',
            		],
            ]);
            Route::post('articles/store', ['as' => 'admin.articles.store', 'uses' => 'AdminArticlesController@adminStore']);
            Route::post('pages/store', ['as' => 'admin.pages.store', 'uses' => 'AdminArticlesController@adminStore']);
            Route::put('articles/update/{id}', ['as' => 'admin.articles.update', 'uses' => 'AdminArticlesController@adminUpdate']);
            Route::put('pages/update/{id}', ['as' => 'admin.pages.update', 'uses' => 'AdminArticlesController@adminUpdate']);
            Route::get('/articles/drafts', ['as' => 'admin.articles.drafts', 'uses' => 'AdminArticlesController@draftsList']);
            
            //To remove the bug where no permissions get assigned on the creation of new role.
            Route::post('roles/store', ['as' => 'admin.roles.store', 'uses' => 'AdminRolesController@store']);

            //get lists for menu page
            Route::get('/article/get_article_list', ['uses' => 'AdminArticlesController@getAllArticleNames']);
            Route::get('/video/get_video_list', ['uses' => 'VideosController@getAllVideoNames']);
            Route::get('/page/get_page_list', ['uses' => 'AdminArticlesController@getAllPageNames']);
            Route::get('/category/get_category_list', ['uses' => 'AdminCategoriesController@getAllCategoryNamesList']);
            Route::get('/menu/get_menu_list', ['uses' => 'MenuController@getAllMenuNames']);
            Route::get('/module/get_module_list', ['uses' => 'ModulesController@getAllModulesNames']);
            
            //search queries
           Route::get('/articles/search', ['as' => 'admin.articles.search', 'uses' => 'AdminArticlesController@search']);
           Route::get('/articles/draft/search', ['as' => 'admin.articles.drafts.search', 'uses' => 'AdminArticlesController@searchDraft']);
           Route::get('/pages/search', ['as' => 'admin.pages.search', 'uses' => 'AdminArticlesController@search']);
           Route::get('/videos/search', ['as' => 'admin.videos.search', 'uses' => 'VideosController@search']);
           Route::get('/widgets/search', ['as' => 'admin.widgets.search', 'uses' => 'WidgetsController@search']);
           
           //Contacts queries
           Route::get('/contact/', ['as' => 'admin.contacts.index', 'uses' => 'AdminContactController@index']);
           Route::get('/contact/show/{id}', ['as' => 'admin.contacts.show', 'uses' => 'AdminContactController@show']);
           Route::delete('/contact/{id}', ['as' => 'admin.contacts.destroy', 'uses' => 'AdminContactController@destroy']);
           
           //News queries
           Route::get('/news/', ['as' => 'admin.news.index', 'uses' => 'AdminNewsController@index']);
           Route::get('/news/show/{id}', ['as' => 'admin.news.show', 'uses' => 'AdminNewsController@show']);
           Route::delete('/news/{id}', ['as' => 'admin.news.destroy', 'uses' => 'AdminNewsController@destroy']);
           
           //tags suggestion routes
           Route::get('/tags/search/',['as'=> 'admin.tags.search', 'uses'=>'TagsController@search']);
      
            Route::resource('articles', 'AdminArticlesController', [
                'except' => 'show',
                'names' => [
                    'index' => 'admin.articles.index',
                    'create' => 'admin.articles.create',
                    'show' => 'admin.articles.show',
                    'edit' => 'admin.articles.edit',
                    'destroy' => 'admin.articles.destroy'
                ],
            ]);

            Route::resource('pages', 'AdminArticlesController', [
                'except' => 'show',
                'names' => [
                    'index' => 'admin.pages.index',
                    'create' => 'admin.pages.create',
                    'show' => 'admin.pages.show',
                    'update' => 'admin.pages.update',
                    'edit' => 'admin.pages.edit',
                    'destroy' => 'admin.pages.destroy',
                ],
            ]);

            Route::resource('videos', 'VideosController', [
                'except' => 'show',
                'names' => [
                    'index' => 'admin.videos.index',
                    'create' => 'admin.videos.create',
                    'store' => 'admin.videos.store',
                    'show' => 'admin.videos.show',
                    'update' => 'admin.videos.update',
                    'edit' => 'admin.videos.edit',
                    'destroy' => 'admin.videos.destroy',
                ],
            ]);
			
            
            
            Route::any('widgets/choose', ['as' => 'admin.widgets.choose', 'uses' => 'WidgetsController@chooseWidgetType']);
            Route::any('widgets/predefined', ['as' => 'admin.widgets.predefined', 'uses' => 'WidgetsController@preDefinedWidget']);
            Route::resource('widgets', 'WidgetsController', [
                'except' => 'show',
                'names' => [
                    'index' => 'admin.widgets.index',
                    'create' => 'admin.widgets.create',
                    'store' => 'admin.widgets.store',
                    'show' => 'admin.widgets.show',
                    'update' => 'admin.widgets.update',
                    'edit' => 'admin.widgets.edit',
                    'destroy' => 'admin.widgets.destroy',
                ],
            ]);

            Route::resource('menus', 'MenuController', [
                'except' => 'show',
                'names' => [
                    'index' => 'admin.menus.index',
                    'create' => 'admin.menus.create',
                    'store' => 'admin.menus.store',
                    'show' => 'admin.menus.show',
                    'update' => 'admin.menus.update',
                    'edit' => 'admin.menus.edit',
                    'destroy' => 'admin.menus.destroy',
                ],
            ]);
           
        });
        Route::group(['namespace' => 'Pingpong\Admin\Controllers'], function () {
            
            Route::resource('users', 'UsersController', [
                'except' => 'show',
                'names' => [
                    'index' => 'admin.users.index',
                    'create' => 'admin.users.create',
                    'store' => 'admin.users.store',
                    'show' => 'admin.users.show',
                    'update' => 'admin.users.update',
                    'edit' => 'admin.users.edit',
                    'destroy' => 'admin.users.destroy',
                ],
            ]);

            Route::resource('roles', 'RolesController', [
                'except' => 'show, store',
                'names' => [
                    'index' => 'admin.roles.index',
                    'create' => 'admin.roles.create',
                   
                    'show' => 'admin.roles.show',
                    'update' => 'admin.roles.update',
                    'edit' => 'admin.roles.edit',
                    'destroy' => 'admin.roles.destroy',
                ],
            ]);
            Route::resource('permissions', 'PermissionsController', [
                'except' => 'show',
                'names' => [
                    'index' => 'admin.permissions.index',
                    'create' => 'admin.permissions.create',
                    'store' => 'admin.permissions.store',
                    'show' => 'admin.permissions.show',
                    'update' => 'admin.permissions.update',
                    'edit' => 'admin.permissions.edit',
                    'destroy' => 'admin.permissions.destroy',
                ],
            ]);
            
           

            // backup & reset
            Route::get('backup/reset', ['as' => 'admin.reset', 'uses' => 'SiteController@reset']);
            Route::get('app/reinstall', ['as' => 'admin.reinstall', 'uses' => 'SiteController@reinstall']);
            Route::get('cache/clear', ['as' => 'admin.cache.clear', 'uses' => 'SiteController@clearCache']);
        });
    });
});

	//Media manager
	Route::group(['namespace' => 'Modules\Admin\Http\Controllers','middleware' => config('admin.filter.auth')], function () {
		Route::get('admin/filemanager/showModal', ['as'=>'admin.filemanager.showModal','uses'=> 'FilemanagerLaravelController@getShowModal']);
		Route::get('admin/filemanager/show', ['as'=>'admin.filemanager.show','uses'=> 'FilemanagerLaravelController@getShow']);
		Route::get('admin/{name}/connectors', 'FilemanagerLaravelController@getConnectors');
		Route::post('admin/{name}/connectors', 'FilemanagerLaravelController@postConnectors');
	});
	