<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use VeiligLanceren\LaravelMorphCategories\Models\Category;
use VeiligLanceren\LaravelMorphCategories\Support\Traits\HasCategory;

class CategoryableTestModel extends Model
{
    use HasCategory;

    protected $table = 'categoryable_test_models';
    protected $guarded = [];
    public $timestamps = false;
}

beforeEach(function () {
    uses(RefreshDatabase::class);

    Schema::create('categoryable_test_models', function ($table) {
        $table->id();
    });

    $this->model = CategoryableTestModel::create();

    $this->cat1 = Category::create(['name' => 'Cat 1', 'slug' => 'cat-1']);
    $this->cat2 = Category::create(['name' => 'Cat 2', 'slug' => 'cat-2']);

    $this->model->attachCategories([$this->cat1->id, $this->cat2->id]);
});

it('can attach categories', function () {
    $model = CategoryableTestModel::create();
    $cat1 = Category::create(['name' => 'Cat 1', 'slug' => 'cat-1']);
    $cat2 = Category::create(['name' => 'Cat 2', 'slug' => 'cat-2']);

    $model->attachCategories([$cat1->id, $cat2->id]);

    expect($model->categories()->count())->toBe(2);
    expect($model->categories()->pluck('id'))->toContain($cat1->id, $cat2->id);
});

it('can detach categories', function () {
    $model = CategoryableTestModel::create();
    $cat1 = Category::create(['name' => 'Cat 1', 'slug' => 'cat-1']);

    $model->attachCategories($cat1->id);
    $model->detachCategories($cat1->id);

    expect($model->categories()->count())->toBe(0);
});

it('can sync categories', function () {
    $model = CategoryableTestModel::create();
    $cat1 = Category::create(['name' => 'Cat 1', 'slug' => 'cat-1']);
    $cat2 = Category::create(['name' => 'Cat 2', 'slug' => 'cat-2']);

    $model->syncCategories([$cat1->id]);
    expect($model->categories()->pluck('id'))->toContain($cat1->id);

    $model->syncCategories([$cat2->id]);
    expect($model->categories()->pluck('id'))->toContain($cat2->id);
    expect($model->categories()->pluck('id'))->not->toContain($cat1->id);
});

it('can check category by id', function () {
    expect($this->model->hasCategory($this->cat1->id))->toBeTrue();
});

it('can check category by model instance', function () {
    expect($this->model->hasCategory($this->cat1))->toBeTrue();
});

it('can check category by slug', function () {
    expect($this->model->hasCategory('cat-1'))->toBeTrue();
});

it('returns false for unknown slug', function () {
    expect($this->model->hasCategory('cat-nonexistent'))->toBeFalse();
});

it('returns false for unknown id', function () {
    expect($this->model->hasCategory(999))->toBeFalse();
});