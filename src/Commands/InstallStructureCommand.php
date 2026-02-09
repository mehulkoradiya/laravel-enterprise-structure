<?php

namespace Vendor\EnterpriseStructure\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallStructureCommand extends Command
{
    protected $signature = 'enterprise:install';
    protected $description = 'Install enterprise project structure';

    public function handle()
    {
        $paths = config('enterprise-structure.paths');

        foreach ($paths as $path) {
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
                File::put($path . '/.gitkeep', '');
            }
        }

        $this->info('Enterprise structure installed successfully.');
    }
}
