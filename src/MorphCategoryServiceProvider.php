<?php

namespace VeiligLanceren\LaravelMorphCategories;

use Illuminate\Support\ServiceProvider;

class MorphCategoryServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/category.php', 'category');

        if ($this->app->runningInConsole()) {
            $this->commands([

            ]);
        }
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/category.php' => config_path('category.php'),
        ], 'category-config');

        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'category-migration');
    }
}
