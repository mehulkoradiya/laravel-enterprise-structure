<?php

namespace Vendor\EnterpriseStructure\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Vendor\EnterpriseStructure\Support\PathResolver;
use Vendor\EnterpriseStructure\Support\NamespaceResolver;

class MakeDomainModelCommand extends Command
{
    protected $signature = 'make:domain-model {name} {--force}';
    protected $description = 'Create a model inside a domain';

    public function handle()
    {
        [$domain, $class] = explode('/', $this->argument('name'));

        $basePath = config('enterprise-structure.paths.domains');
        $path = "{$basePath}/{$domain}/Models/{$class}.php";

        if (File::exists($path) && ! $this->option('force')) {
            $this->error("Model already exists. Use --force to overwrite.");
            return Command::FAILURE;
        }

        File::ensureDirectoryExists(dirname($path));

        $stub = File::get(__DIR__.'/../Stubs/domain/model.stub');

        $namespace = config('enterprise-structure.namespaces.domains')
            ."\\{$domain}\\Models";

        $content = str_replace(
            ['{{ namespace }}', '{{ class }}'],
            [$namespace, $class],
            $stub
        );

        File::put($path, $content);

        $this->info("Model created: {$path}");

        return Command::SUCCESS;
    }
}
