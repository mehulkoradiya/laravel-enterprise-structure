<?php

namespace Vendor\EnterpriseStructure\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeDomainCommand extends Command
{
    protected $signature = 'make:domain {name} {--force}';
    protected $description = 'Create a new domain structure';

    public function handle()
    {
        $domain = trim($this->argument('name'));

        if (! preg_match('/^[A-Z][A-Za-z0-9]+$/', $domain)) {
            $this->error('Domain name must be StudlyCase (e.g. User, Billing).');
            return Command::FAILURE;
        }

        $domainsPath = config('enterprise-structure.paths.domains');
        $domainPath = $domainsPath . DIRECTORY_SEPARATOR . $domain;

        if (File::exists($domainPath) && ! $this->option('force')) {
            $this->error("Domain [{$domain}] already exists. Use --force to overwrite.");
            return Command::FAILURE;
        }

        $directories = [
            'Actions',
            'Models',
            'Policies',
            'Repositories',
        ];

        File::makeDirectory($domainPath, 0755, true);
        File::put($domainPath . '/.gitkeep', '');

        foreach ($directories as $directory) {
            $path = $domainPath . DIRECTORY_SEPARATOR . $directory;

            File::makeDirectory($path, 0755, true);
            File::put($path . '/.gitkeep', '');
        }

        $this->info("Domain [{$domain}] created successfully.");
        $this->line("Location: {$domainPath}");

        return Command::SUCCESS;
    }
}
