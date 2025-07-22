<?php

use VeiligLanceren\LaravelMorphCategories\Models\Category;
use VeiligLanceren\LaravelMorphCategories\Models\Categoryable;

return [
    'tables' => [
        'categories' => 'categories',
        'categoryables' => 'categoryables',
    ],

    'models' => [
        'category' => Category::class,
        'categoryable' => Categoryable::class,
    ],
];