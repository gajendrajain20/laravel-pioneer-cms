<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__.'/../../config/l5-swagger.php';
    	$this->mergeConfigFrom($configPath, 'l5-swagger');
    }
}
