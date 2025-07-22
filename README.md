# Laravel Morph Category

[![Latest Version on Packagist](https://img.shields.io/packagist/v/veiliglanceren/laravel-morph-categories.svg?style=flat-square)](https://packagist.org/packages/veiliglanceren/laravel-morph-category)
[![Total Downloads](https://img.shields.io/packagist/dt/veiliglanceren/laravel-morph-categories.svg?style=flat-square)](https://packagist.org/packages/veiliglanceren/laravel-morph-category)

A Laravel package to add polymorphic category support to any model. Easily attach, detach, sync, and query categories using elegant Eloquent relationships.

---

## 🚀 Installation

```bash
composer require veiliglanceren/laravel-morph-categories
```

---

## 📦 Usage

### 1. Add Trait to Your Model

```php
use VeiligLanceren\LaravelMorphCategories\Traits\HasCategory;

class Post extends Model
{
    use HasCategory;
}
```

### 2. Attach, Detach & Sync Categories

```php
$post = Post::find(1);
$category = Category::create(['name' => 'News']);

$post->attachCategory($category);
$post->detachCategory($category);
$post->syncCategories([$category->id]);
```

You can also use slugs or IDs:

```php
$post->hasCategory('news'); // by slug
$post->hasCategory($category); // by model
$post->hasCategory($category->id); // by ID
```

---

### ✅ Use Cases

- Rename tables if you already use `categories` for something else.
- Replace the model class with your own `Category` or `Categoryable` implementation.

## ⚙️ Configuration

You can publish and customize the config file:

```bash
php artisan vendor:publish --tag=category-config
```

This will create a file at `config/category.php` with the following structure:

```php
return [

    'tables' => [
        'categories' => 'categories',
        'categoryables' => 'categoryables',
    ],

    'models' => [
        'category' => \VeiligLanceren\LaravelMorphCategories\Models\Category::class,
        'categoryable' => \VeiligLanceren\LaravelMorphCategories\Models\Categoryable::class,
    ],
];
```

## 🔁 Relationships

```php
$post->categories; // Collection of Category models

$category->categoryables; // MorphToMany to all related models
```

---

## 🔍 Query Scoping

You can query models with specific categories:

```php
Post::withCategory('news')->get();
Post::withCategory($category)->get();
```

---

## 🧪 Testing

This package uses [Pest](https://pestphp.com) and [Orchestra Testbench](https://github.com/orchestral/testbench):

```bash
composer test
```

Or manually:

```bash
vendor/bin/pest
```

---

## 📄 License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

---

## 👤 Author

Developed and maintained by [Niels Hamelink](https://linkedin.com/in/niels-hamelink) at [VeiligLanceren.nl](https://veiliglanceren.nl).