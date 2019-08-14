<?php

namespace Urmis\Verifies;

use Illuminate\Support\Collection;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class VerifiesServiceProvider extends ServiceProvider
{
    public function boot(Filesystem $filesystem)
    {
        // TODO: Check if the project is not Lumen

        $this->publishes([
            __DIR__.'/../database/migrations/create_verifies_table.php' => $this->getMigrationFileName($filesystem),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../config/verifies.php' => config_path('verifies.php'),
        ], 'config');

        $this->app->singleton('verifies', function ($app) {
            return new Verifies();
        });
    }

    /**
     * Returns existing migration file if found, else uses the current timestamp.
     *
     * @param Filesystem $filesystem
     * @return string
     */
    protected function getMigrationFileName(Filesystem $filesystem): string
    {
        $timestamp = date('Y_m_d_His');
        return Collection::make($this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem) {
                return $filesystem->glob($path.'*_create_verifies_table.php');
            })->push($this->app->databasePath()."/migrations/{$timestamp}_create_verifies_table.php")
            ->first();
    }
}
