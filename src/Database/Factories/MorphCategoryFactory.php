<?php

namespace VeiligLanceren\LaravelMorphCategories\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use VeiligLanceren\LaravelMorphCategories\Models\MorphCategory;

class MorphCategoryFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = MorphCategory::class;

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
     * @param MorphCategory $parent
     * @return $this
     */
    public function withParent(MorphCategory $parent): static
    {
        return $this->state(fn () => ['parent_id' => $parent->id]);
    }
}
