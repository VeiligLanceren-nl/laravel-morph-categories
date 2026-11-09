<?php

namespace Tests;

use Illuminate\Support\InteractsWithTime;
use Orchestra\Testbench\TestCase as BaseTestCase;
use VeiligLanceren\LaravelMorphCategories\MorphCategoryServiceProvider;

class TestCase extends BaseTestCase
{
    use InteractsWithTime;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @param $app
     * @return string[]
     */
    protected function getPackageProviders($app): array
    {
        $providers = [MorphCategoryServiceProvider::class];

        // spatie/laravel-sluggable ^4 registers its action config via a service provider.
        if (class_exists(\Spatie\Sluggable\SluggableServiceProvider::class)) {
            array_unshift($providers, \Spatie\Sluggable\SluggableServiceProvider::class);
        }

        return $providers;
    }

    /**
     * @return void
     */
    protected function defineDatabaseMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadMigrationsFrom(__DIR__ . '/../vendor/veiliglanceren/laravel-morph-categories/database/migrations');
    }

    /**
     * @param $app
     * @return void
     */
    protected function defineEnvironment($app): void
    {
        $app['config']->set('filesystems.default', 'public');
        $app['config']->set('filesystems.disks.public', [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ]);
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }
}