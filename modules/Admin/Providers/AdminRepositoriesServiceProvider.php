<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Modules\Admin\Providers;

use Pingpong\Admin\Providers\RepositoriesServiceProvider;

/**
 * Description of RepositoriesServiceProvider
 *
 * @author admin
 */
class AdminRepositoriesServiceProvider extends RepositoriesServiceProvider
{

    protected $entities = [
        'User',
        'Article',
        'Page',
        'Category',
        'Role',
        'Permission',
        'Tag',
        'ArticleTag',
        'Video',
        'Menu',
        'Widget',
        'WidgetPosition',
        'WidgetMenu',
        'ArticleCategory',
        'MenuType',
        'Template',
        'Module'
    ]
    ;

    /**
     * Register the service provider.
     */
    public function register()
    {
        foreach ($this->entities as $entity) {
            $this->{'bind' . $entity . 'Repository'}();
        }
    }

    protected function bindArticleRepository()
    {
        $this->app->bind('Pingpong\Admin\Repositories\Articles\ArticleRepository', 
            'Modules\Admin\Repositories\Articles\EloquentAdminArticleRepository');
    }

    protected function bindPageRepository()
    {
        $this->app->bind('Pingpong\Admin\Repositories\Pages\PageRepository', 
            'Modules\Admin\Repositories\Pages\EloquentAdminPagesRepository');
    }

    protected function bindTagRepository()
    {
        $this->app->bind('Modules\Admin\Repositories\Tag\TagRepository', 
            'Modules\Admin\Repositories\Tag\EloquentTagRepository');
    }

    protected function bindMenuTypeRepository()
    {
        $this->app->bind('Modules\Admin\Repositories\MenuType\MenuTypeRepository', 
            'Modules\Admin\Repositories\MenuType\EloquentMenuTypeRepository');
    }

    protected function bindWidgetPositionRepository()
    {
        $this->app->bind('Modules\Admin\Repositories\WidgetPosition\WidgetPositionRepository', 
            'Modules\Admin\Repositories\WidgetPosition\EloquentWidgetPositionRepository');
    }

    protected function bindArticleTagRepository()
    {
        $this->app->bind('Modules\Admin\Repositories\ArticleTag\ArticleTagRepository', 
            'Modules\Admin\Repositories\ArticleTag\EloquentArticleTagRepository');
    }

    protected function bindWidgetMenuRepository()
    {
        $this->app->bind('Modules\Admin\Repositories\WidgetMenu\WidgetMenuRepository', 
            'Modules\Admin\Repositories\WidgetMenu\EloquentWidgetMenuRepository');
    }

    protected function bindArticleCategoryRepository()
    {
        $this->app->bind('Modules\Admin\Repositories\ArticleCategory\ArticleCategoryRepository', 
            'Modules\Admin\Repositories\ArticleCategory\EloquentArticleCategoryRepository');
    }

    protected function bindVideoRepository()
    {
        $this->app->bind('Modules\Admin\Repositories\Video\VideoRepository', 
            'Modules\Admin\Repositories\Video\EloquentVideoRepository');
    }

    protected function bindWidgetRepository()
    {
        $this->app->bind('Modules\Admin\Repositories\Widget\WidgetRepository', 
            'Modules\Admin\Repositories\Widget\EloquentWidgetRepository');
    }

    protected function bindMenuRepository()
    {
        $this->app->bind('Modules\Admin\Repositories\Menu\MenuRepository', 
            'Modules\Admin\Repositories\Menu\EloquentMenuRepository');
    }

    protected function bindCategoryRepository()
    {
        $this->app->bind('Pingpong\Admin\Repositories\Categories\CategoryRepository', 
            'Modules\Admin\Repositories\Categories\EloquentAdminCategoryRepository', 
            'Pingpong\Admin\Repositories\Categories\EloquentCategoryRepository');
    }

    protected function bindTemplateRepository()
    {
        $this->app->bind('Modules\Admin\Repositories\Templates\TemplateRepository', 
            'Modules\Admin\Repositories\Templates\EloquentTemplateRepository');
    }

    protected function bindModuleRepository()
    {
        $this->app->bind('Modules\Admin\Repositories\Modules\ModuleRepository', 
            'Modules\Admin\Repositories\Modules\EloquentModuleRepository');
    }
}
