<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modules\Frontend\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Description of RepositoriesServiceProvider
 *
 * @author admin
 */
class FrontendRepositoriesServiceProvider extends ServiceProvider {

    protected $entities = [
        'news',
        'contact'        
    ];

    /**
     * Register the service provider.
     */
    public function register() {
        foreach ($this->entities as $entity) {
            $this->{'bind' . $entity . 'Repository'}();
        }
    }

    protected function bindNewsRepository() {
        $this->app->bind(
                'Modules\Frontend\Repositories\Contact\ContactRepository',
        		'Modules\Frontend\Repositories\Contact\EloquentContactRepository'
        );
    }

    protected function bindContactRepository()
    {
        $this->app->bind(
            'Modules\Frontend\Repositories\News\NewsRepository',
            'Modules\Frontend\Repositories\News\EloquentNewsRepository'
        );
    }
}
