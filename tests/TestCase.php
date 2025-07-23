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
        return [
            MorphCategoryServiceProvider::class,
        ];
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