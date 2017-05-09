<?php

Route::group(['middleware'=>'App\Http\Middleware\TestAdminMiddleware','namespace' => 'Modules\Frontend\Http\Controllers'], function()
{
        Route::group(['middleware' => 'frontend_guest'], function () {
            Route::resource('login', 'LoginController', [
                'only' => ['index', 'store'],
                'names' => [
                    'index' => 'frontend.login.index',
                    'store' => 'frontend.login.store',
                ],
            ]);
            
            Route::resource('register', 'RegisterController', [
                'only' => ['index', 'store'],
                'names' => [
                    'index' => 'frontend.register.index',
                    'store' => 'frontend.register.store',
                ],
            ]);
        });
        
        Route::group(['middleware' => config('frontend.filter.auth')], function () {
            Route::get('/', ['as' => 'frontend.home', 'uses' => 'FrontendController@index']);
            Route::get('/logout', ['as' => 'frontend.logout', 'uses' => 'LoginController@logout']);
        });
	    
        Route::get('/article/{id}', ['as'=>'frontend.article.index', 'uses' => 'ArticleController@index']);
        Route::get('/page/{id}', ['uses' => 'PageController@index']);
        Route::get('/category/{id}', ['uses' => 'CategoryController@index']);
        Route::get('/contact/', ['as' => 'frontend.contact.index', 'uses' => 'ContactController@index']);
        Route::get('/submit-news/', ['as' => 'frontend.news.index', 'uses' => 'NewsController@index']);
        Route::get('/tag/{tagName}', ['uses' => 'TagsController@index']);
        
        Route::post('/contact/', ['as' => 'frontend.contact.store', 'uses' => 'ContactController@store']);
        Route::post('/submit-news/', ['as' => 'frontend.news.store', 'uses' => 'NewsController@store']);
        Route::get('/video/', ['uses' => 'VideoController@index']);
        Route::get('/video/{id}', ['uses' => 'VideoController@getVideoById']);
        
        Route::any('/preview/', ['as' => 'frontend.preview', 'uses' => 'ArticleController@preview']);
});