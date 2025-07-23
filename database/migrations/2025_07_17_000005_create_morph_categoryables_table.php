<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create(config('category.tables.categoryables', 'morph_categoryables'), function (Blueprint $table) {
            $table->foreignId('morph_category_id')
                ->constrained(config('category.tables.categories', 'morph_categories'))
                ->cascadeOnDelete();

            $table->morphs('morph_categoryable');
            $table->primary(['morph_category_id', 'morph_categoryable_id', 'morph_categoryable_type'], 'morph_categoryables_primary');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('category.tables.categoryables', 'morph_categoryables'));
    }
};