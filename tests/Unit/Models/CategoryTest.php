<?php

use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;
use VeiligLanceren\LaravelMorphCategories\Models\Category;

uses(RefreshDatabase::class);

it('can create a category', function () {
    $category = Category::factory()->create();

    expect($category->slug)
        ->toBe(Str::replace(
            [' '],
            ['-'],
            Str::lower($category->name)
        ));
});

it('can have a parent category', function () {
    $parent = Category::factory()->create(['name' => 'Parent']);
    $child = Category::factory()->create([
        'name' => 'Child',
        'parent_id' => $parent->id,
    ]);

    expect($child->parent)->not->toBeNull()
        ->and($child->parent->id)->toBe($parent->id);
});

it('can have children categories', function () {
    $parent = Category::factory()->create();
    $child1 = Category::factory()->create(['parent_id' => $parent->id]);
    $child2 = Category::factory()->create(['parent_id' => $parent->id]);

    expect($parent->children)->toHaveCount(2)
        ->and($parent->children->pluck('id'))->toContain($child1->id, $child2->id);
});

it('slug is generated correctly', function () {
    $category = Category::factory()->create();

    expect($category->slug)->toBe(Str::replace([' '], ['-'], Str::lower($category->name)));
});