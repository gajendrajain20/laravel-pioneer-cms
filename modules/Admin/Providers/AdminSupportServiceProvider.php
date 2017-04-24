<?php

namespace Modules\Admin\Providers;

use Pingpong\Admin\Providers\SupportServiceProvider;


class AdminSupportServiceProvider extends SupportServiceProvider
{
   

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        require __DIR__.'/../permissions.php';
        require __DIR__.'/../composers.php';
    }
}
