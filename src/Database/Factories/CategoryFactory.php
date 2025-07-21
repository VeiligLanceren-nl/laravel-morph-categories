<?php

namespace VeiligLanceren\LaravelMorphCategories\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use VeiligLanceren\LaravelMorphCategories\Models\Category;

class CategoryFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Category::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        $name = $this->faker->words(2, true);

        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'parent_id' => null,
        ];
    }

    /**
     * @param Category $parent
     * @return $this
     */
    public function withParent(Category $parent): static
    {
        return $this->state(fn () => ['parent_id' => $parent->id]);
    }
}
