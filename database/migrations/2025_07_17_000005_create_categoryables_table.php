<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categoryables', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->morphs('categoryable');
            $table->primary(['category_id', 'categoryable_id', 'categoryable_type'], 'categoryables_primary');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categoryables');
    }
};
