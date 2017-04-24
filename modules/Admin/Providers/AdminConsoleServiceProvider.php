<?php

namespace Modules\Admin\Providers;

use Pingpong\Admin\Providers\ConsoleServiceProvider;

class AdminConsoleServiceProvider extends ConsoleServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * The available command shortname.
     *
     * @var array
     */
    protected $commands = [
        'Seed'
    ];
    
//     protected $commands = [
//     		'Seed',
//     		'Refresh',
//     		'Install',
//     		'Migration',
//     		'CreateUser',
//     ];

    /**
     * Register the commands.
     */
    public function register()
    {
        foreach ($this->commands as $command) {
            $this->commands('Modules\\Admin\\Console\\'.$command.'Command');
        }
    }

    /**
     * @return array
     */
    public function provides()
    {
        $provides = [];

        foreach ($this->commands as $command) {
            $provides[] = 'Pingpong\\Admin\\Console\\'.$command.'Command';
        }

        return $provides;
    }
}
