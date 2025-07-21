<?php

namespace VeiligLanceren\LaravelMorphCategories\Support\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use VeiligLanceren\LaravelMorphCategories\Models\Category;

trait HasCategory
{
    /**
     * Get all categories related to the model.
     *
     * @return MorphToMany
     */
    public function categories(): MorphToMany
    {
        /** @var Model $this */
        return $this->morphToMany(Category::class, 'categoryable');
    }

    /**
     * Attach one or multiple categories to the model.
     *
     * @param  int|array|Collection|Model $categories
     * @return void
     */
    public function attachCategories($categories): void
    {
        $this->categories()->attach($categories);
    }

    /**
     * Detach one or multiple categories from the model.
     *
     * @param  int|array|Collection|Model|null  $categories
     * @return void
     */
    public function detachCategories($categories = null): void
    {
        $this->categories()->detach($categories);
    }

    /**
     * Sync categories for the model.
     *
     * @param  int|array|Collection  $categories
     * @return void
     */
    public function syncCategories($categories): void
    {
        $this->categories()->sync($categories);
    }

    /**
     * Check if the model has a given category.
     *
     * @param Category|int|string $category
     * @return bool
     */
    public function hasCategory(Category|int|string $category): bool
    {
        if ($category instanceof Category) {
            $categoryId = $category->getKey();
        } elseif (is_numeric($category)) {
            $categoryId = $category;
        } elseif (is_string($category)) {
            $categoryId = Category::query()
                ->where('slug', $category)
                ->value('id');

            if (!$categoryId) {
                return false;
            }
        } else {
            return false;
        }

        return $this->categories()->pluck('id')->contains($categoryId);
    }
}