<?php

namespace VeiligLanceren\LaravelMorphCategories\Support\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasCategory
{
    /**
     * Get all categories related to the model.
     *
     * @return MorphToMany
     */
    public function categories(): MorphToMany
    {
        return $this->morphToMany(
            category_model(),
            'categoryable',
            categoryable_table()
        );
    }

    /**
     * Attach one or multiple categories to the model.
     *
     * @param  int|array|Collection|Model $categories
     * @return void
     */
    public function attachCategories(mixed $categories): void
    {
        $this->categories()->attach($categories);
    }

    /**
     * Detach one or multiple categories from the model.
     *
     * @param  int|array|Collection|Model|null  $categories
     * @return void
     */
    public function detachCategories(mixed $categories = null): void
    {
        $this->categories()->detach($categories);
    }

    /**
     * Sync categories for the model.
     *
     * @param  int|array|Collection  $categories
     * @return void
     */
    public function syncCategories(mixed $categories): void
    {
        $this->categories()->sync($categories);
    }

    /**
     * Check if the model has a given category.
     *
     * @param Model|int|string $category
     * @return bool
     */
    public function hasCategory(Model|int|string $category): bool
    {
        if ($category instanceof Model) {
            $categoryId = $category->getKey();
        } elseif (is_numeric($category)) {
            $categoryId = $category;
        } elseif (is_string($category)) {
            $categoryId = category_model()::query()
                ->where('slug', $category)
                ->value('id');

            if (!$categoryId) {
                return false;
            }
        } else {
            return false;
        }

        return $this->categories()
            ->pluck('id')
            ->contains($categoryId);
    }

}
