<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create(config('category.tables.categoryables', 'categoryables'), function (Blueprint $table) {
            $table->foreignId('category_id')
                ->constrained(config('category.tables.categories', 'categories'))
                ->cascadeOnDelete();

            $table->morphs('categoryable');
            $table->primary(['category_id', 'categoryable_id', 'categoryable_type'], 'categoryables_primary');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('category.tables.categoryables', 'categoryables'));
    }
};