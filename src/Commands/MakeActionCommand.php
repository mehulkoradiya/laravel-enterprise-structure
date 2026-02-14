<?php

namespace Vendor\EnterpriseStructure\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Vendor\EnterpriseStructure\Support\PathResolver;
use Vendor\EnterpriseStructure\Support\NamespaceResolver;

class MakeActionCommand extends Command
{
    protected $signature = 'make:action {name} {--force}';
    protected $description = 'Create a domain action';

    public function handle()
    {
        [$domain, $class] = $this->parseInput();

        $path = PathResolver::domainActionPath($domain, $class);

        if (File::exists($path) && ! $this->option('force')) {
            $this->error("Action already exists. Use --force to overwrite.");
            return Command::FAILURE;
        }

        File::ensureDirectoryExists(dirname($path));

        $stub = File::get(__DIR__ . '/../Stubs/domain/action.stub');

        $content = str_replace(
            ['{{ namespace }}', '{{ class }}'],
            [
                NamespaceResolver::domainAction($domain),
                $class
            ],
            $stub
        );

        File::put($path, $content);

        $this->info("Action created: {$path}");

        return Command::SUCCESS;
    }

    protected function parseInput(): array
    {
        $input = explode('/', $this->argument('name'));

        if (count($input) !== 2) {
            $this->error("Format must be Domain/Class");
            exit;
        }

        return [$input[0], $input[1]];
    }
}
