<?php

use VeiligLanceren\LaravelMorphCategories\Models\MorphCategory;
use VeiligLanceren\LaravelMorphCategories\Models\MorphCategoryable;

return [
    'tables' => [
        'categories' => 'morph_categories',
        'categoryables' => 'morph_categoryables',
    ],

    'models' => [
        'category' => MorphCategory::class,
        'categoryable' => MorphCategoryable::class,
    ],
];