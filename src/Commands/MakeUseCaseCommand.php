<?php

namespace Vendor\EnterpriseStructure\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Vendor\EnterpriseStructure\Support\PathResolver;
use Vendor\EnterpriseStructure\Support\NamespaceResolver;

class MakeUseCaseCommand extends Command
{
    protected $signature = 'make:usecase {name} {--force}';
    protected $description = 'Create an application use case';

    public function handle()
    {
        [$domain, $class] = $this->parseInput();

        $path = PathResolver::useCasePath($domain, $class);

        if (File::exists($path) && ! $this->option('force')) {
            $this->error("UseCase already exists. Use --force to overwrite.");
            return Command::FAILURE;
        }

        File::ensureDirectoryExists(dirname($path));

        $stub = File::get(__DIR__ . '/../Stubs/usecase/usecase.stub');

        $content = str_replace(
            ['{{ namespace }}', '{{ class }}'],
            [
                NamespaceResolver::useCase($domain),
                $class
            ],
            $stub
        );

        File::put($path, $content);

        $this->info("UseCase created: {$path}");

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
