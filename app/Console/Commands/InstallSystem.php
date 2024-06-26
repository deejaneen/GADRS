<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallSystem extends Command
{
    protected $signature = 'install:system';

    protected $description = 'Install the system step by step';

    public function handle()
    {
        // Step 1: Prioritize specific table migrations
        $this->info('Migrating specific tables...');
        $this->call('migrate', [
            '--path' => 'database/migrations/2014_10_12_000000_create_users_table.php',
        ]);
        $this->call('migrate', [
            '--path' => 'database/migrations/2024_04_23_072438_form-numbers_table.php',
        ]);

        // Step 2: Migrate the rest of the tables
        $this->info('Migrating remaining tables...');
        $this->call('migrate');

        // Step 3: Perform storage link
        $this->info('Creating storage link...');
        Artisan::call('storage:link');

        $this->info('System installation completed successfully.');
    }
}
