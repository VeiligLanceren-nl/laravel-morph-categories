<?php

namespace VeiligLanceren\LaravelMorphCategories\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Categoryable extends MorphPivot
{
    /**
     * @var string
     */
    protected $table = 'categoryables';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $guarded = [];
}
