<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prevention_tips', function (Blueprint $table) {
            $table->id();

            $table->foreignId('disaster_category_id')
                ->constrained('disaster_categories')
                ->cascadeOnDelete();

            $table->string('title');
            $table->text('content');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prevention_tips');
    }
};
