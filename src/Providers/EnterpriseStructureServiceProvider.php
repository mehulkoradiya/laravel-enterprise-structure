<?php

namespace Vendor\EnterpriseStructure\Providers;

use Illuminate\Support\ServiceProvider;
use Vendor\EnterpriseStructure\Commands\InstallStructureCommand;
use Vendor\EnterpriseStructure\Commands\MakeDomainCommand;
use Vendor\EnterpriseStructure\Commands\MakeActionCommand;
use Vendor\EnterpriseStructure\Commands\MakeUseCaseCommand;

class EnterpriseStructureServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/enterprise-structure.php',
            'enterprise-structure'
        );
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->commands([
                InstallStructureCommand::class,
                MakeDomainCommand::class,
                MakeActionCommand::class,
                MakeUseCaseCommand::class,
            ]);

            $this->publishes([
                __DIR__.'/../../config/enterprise-structure.php'
                => config_path('enterprise-structure.php'),
            ], 'enterprise-structure-config');
        }
    }
}
