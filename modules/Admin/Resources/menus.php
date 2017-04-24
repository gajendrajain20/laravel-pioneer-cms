<?php

	Menu::create('dashboard-menu', function ($menu) {
		$menu->setPresenter('Pingpong\Admin\Presenters\SidebarMenuPresenter');
		$menu->route('admin.home', trans('admin.menus.dashboard'), [], 0, ['icon' => 'fa fa-dashboard']);
	});
	

	Menu::create('posts-menu', function ($menu) {
		$menu->setPresenter('Pingpong\Admin\Presenters\SidebarMenuPresenter');
		$menu->dropdown(trans('admin.menus.articles.title'), function ($sub) {
			$sub->route('admin.articles.index', trans('admin.menus.articles.all'), [], 1);
			$sub->route('admin.articles.create', trans('admin.menus.articles.create'), [], 2);
			$sub->route('admin.articles.drafts', trans('admin.menus.articles.draft'), [], 3);
			$sub->divider(4);
			$sub->route('admin.categories.index', trans('admin.menus.categories'), [], 5);
		}, 1, ['icon' => 'fa fa-book']);
	});
	
	Menu::create('pages-menu', function ($menu) {
		$menu->setPresenter('Pingpong\Admin\Presenters\SidebarMenuPresenter');
		$menu->dropdown(trans('admin.menus.pages.title'), function ($sub) {
			$sub->route('admin.pages.index', trans('admin.menus.pages.all'), [], 1);
			$sub->route('admin.pages.create', trans('admin.menus.pages.create'), [], 2);
		}, 2, ['icon' => 'fa fa-flag']);
	});
	
	Menu::create('videos-menu', function ($menu) {
		$menu->setPresenter('Pingpong\Admin\Presenters\SidebarMenuPresenter');
		$menu->dropdown(trans('admin.menus.video.title'), function ($sub) {
			$sub->route('admin.videos.index', trans('admin.menus.video.all'), [], 1);
			$sub->route('admin.videos.create', trans('admin.menus.video.create'), [], 2);
		}, 3, ['icon' => 'fa fa-video-camera']);
	});
	
	Menu::create('menus-menu', function ($menu) {
		$menu->setPresenter('Pingpong\Admin\Presenters\SidebarMenuPresenter');
		$menu->dropdown(trans('admin.menus.menu.title'), function ($sub) {
			$sub->route('admin.menus.index', trans('admin.menus.menu.all'), [], 1);
			$sub->route('admin.menus.create', trans('admin.menus.menu.create'), [], 2);
		}, 4, ['icon' => 'fa fa-bars']);
	});
	Menu::create('widgets-menu', function ($menu) {
		$menu->setPresenter('Pingpong\Admin\Presenters\SidebarMenuPresenter');
		$menu->dropdown(trans('admin.menus.widget.title'), function ($sub) {
			$sub->route('admin.widgets.index', trans('admin.menus.widget.all'), [], 1);
			$sub->route('admin.widgets.choose', trans('admin.menus.widget.create'), [], 2);
		}, 5, ['icon' => 'fa fa-briefcase']);
	});
	Menu::create('contacts-menu', function ($menu) {
		$menu->setPresenter('Pingpong\Admin\Presenters\SidebarMenuPresenter');
		$menu->route('admin.contacts.index', trans('admin.menus.contacts.title'), [],  6, ['icon' => 'fa fa-question-circle']);
	});
	Menu::create('modules-menu', function ($menu) {
		$menu->setPresenter('Pingpong\Admin\Presenters\SidebarMenuPresenter');
		$menu->route('admin.modules.index', trans('admin.menus.modules.title'), [],  7, ['icon' => 'fa fa-file-archive-o']);
	});
	Menu::create('media_manager-menu', function ($menu) {
		$menu->setPresenter('Pingpong\Admin\Presenters\SidebarMenuPresenter');
		$menu->route('admin.filemanager.show', trans('admin.menus.media-manager.title'), [],  8, ['icon' => 'fa fa-picture-o']);
	});
	Menu::create('news-menu', function ($menu) {
		$menu->setPresenter('Pingpong\Admin\Presenters\SidebarMenuPresenter');
		$menu->route('admin.news.index', trans('admin.menus.news.title'), [],  9, ['icon' => 'fa fa-newspaper-o']);
	});
	Menu::create('positions-menu', function ($menu) {
		$menu->setPresenter('Pingpong\Admin\Presenters\SidebarMenuPresenter');
		$menu->dropdown(trans('admin.menus.positions.title'), function ($sub) {
			$sub->route('admin.positions.index', trans('admin.menus.positions.all'), [], 1);
			$sub->route('admin.positions.create', trans('admin.menus.positions.create'), [], 2);
		}, 10, ['icon' => 'fa fa-map-marker']);
	});
	Menu::create('users-menu', function ($menu) {
		$menu->setPresenter('Pingpong\Admin\Presenters\SidebarMenuPresenter');
		$menu->dropdown(trans('admin.menus.users.title'), function ($sub) {
			$sub->route('admin.users.index', trans('admin.menus.users.all'), [], 1);
			$sub->route('admin.users.create', trans('admin.menus.users.create'), [], 2);
			$sub->divider(3);
			$sub->route('admin.roles.index', trans('admin.menus.roles'), [], 4);
			$sub->route('admin.permissions.index', trans('admin.menus.permissions'), [], 5);
		}, 11, ['icon' => 'fa fa-users']);
	});
	Menu::create('settings-menu', function ($menu) {
		$menu->setPresenter('Pingpong\Admin\Presenters\SidebarMenuPresenter');
		$menu->dropdown(trans('admin.menus.settings'), function ($sub) {
			$sub->route('admin.settings', trans('admin.menus.settings'), [], 1, ['icon' => 'fa fa-cog']);
			$sub->route('admin.templates.index', trans('admin.menus.templates'), [], 2, ['icon' => 'fa fa-files-o']);
			$sub->route('admin.backup', trans('admin.menus.backend'), [], 3, ['icon' => 'fa fa-cog']);
		}, 12, ['icon' => 'fa fa-cog']);
	});
