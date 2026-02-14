<?php

namespace Vendor\EnterpriseStructure\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepositoryCommand extends Command
{
    protected $signature = 'make:repository {name} {--force}';
    protected $description = 'Create a repository inside a domain';

    public function handle()
    {
        [$domain, $class] = explode('/', $this->argument('name'));

        $basePath = config('enterprise-structure.paths.domains');
        $path = "{$basePath}/{$domain}/Repositories/{$class}.php";

        if (File::exists($path) && ! $this->option('force')) {
            $this->error("Repository already exists. Use --force to overwrite.");
            return Command::FAILURE;
        }

        File::ensureDirectoryExists(dirname($path));

        $stub = File::get(__DIR__.'/../Stubs/domain/repository.stub');

        $namespace = config('enterprise-structure.namespaces.domains')
            ."\\{$domain}\\Repositories";

        $content = str_replace(
            ['{{ namespace }}', '{{ class }}'],
            [$namespace, $class],
            $stub
        );

        File::put($path, $content);

        $this->info("Repository created: {$path}");

        return Command::SUCCESS;
    }
}
