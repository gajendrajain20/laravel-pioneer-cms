<?php

Route::group(['prefix' => 'api', 'namespace' => 'Modules\Api\Http\Controllers'], function()
{
	Route::get('/getPostList', 'ApiController@postIndex');
});