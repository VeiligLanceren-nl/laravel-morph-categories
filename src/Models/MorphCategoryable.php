<?php

namespace VeiligLanceren\LaravelMorphCategories\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class MorphCategoryable extends MorphPivot
{
    protected $table;

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('category.tables.categoryables', 'morph_categoryables');
    }

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return MorphTo
     */
    public function categoryable(): MorphTo
    {
        return $this->morphTo(
            __FUNCTION__,
            'morph_categoryable_type',
            'morph_categoryable_id'
        );
    }
}
