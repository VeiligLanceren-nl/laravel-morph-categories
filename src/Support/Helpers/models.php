<?php

use Illuminate\Database\Eloquent\Model;
use VeiligLanceren\LaravelMorphCategories\Models\Category;
use VeiligLanceren\LaravelMorphCategories\Models\Categoryable;

if (! function_exists('category_model')) {
    /**
     * @return class-string<Model> $categoryClass
     */
    function category_model(): string
    {
        return config('category.models.category', Category::class);
    }
}

if (! function_exists('categoryable_model')) {
    /**
     * @return class-string<Model> $categoryableClass
     */
    function categoryable_model(): string
    {
        return config('category.models.categoryable', Categoryable::class);
    }
}

if (! function_exists('category_table')) {
    function category_table(): string
    {
        return config('category.tables.categories', 'categories');
    }
}

if (! function_exists('categoryable_table')) {
    function categoryable_table(): string
    {
        return config('category.tables.categoryables', 'categoryables');
    }
}