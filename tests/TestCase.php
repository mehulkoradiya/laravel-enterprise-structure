<?php

namespace Vendor\EnterpriseStructure\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Vendor\EnterpriseStructure\Providers\EnterpriseStructureServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            EnterpriseStructureServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('enterprise-structure.paths.domains', app_path('Domains'));
        $app['config']->set('enterprise-structure.paths.application', app_path('Application'));

        $app['config']->set('enterprise-structure.namespaces.domains', 'App\\Domains');
        $app['config']->set('enterprise-structure.namespaces.application', 'App\\Application');
    }
}
