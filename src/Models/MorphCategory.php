<?php

namespace VeiligLanceren\LaravelMorphCategories\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use VeiligLanceren\LaravelMorphCategories\Database\Factories\MorphCategoryFactory;

class MorphCategory extends Model
{
    use HasFactory, HasSlug;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('category.tables.categories', 'morph_categories');
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * @return HasMany<MorphCategory>
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * @return HasMany<MorphCategoryable>
     */
    public function morphCategoryables(): HasMany
    {
        return $this->hasMany(MorphCategoryable::class);
    }

    /**
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->usingSeparator('-');
    }

    /**
     * @return MorphCategoryFactory
     */
    protected static function newFactory(): MorphCategoryFactory
    {
        return MorphCategoryFactory::new();
    }
}
