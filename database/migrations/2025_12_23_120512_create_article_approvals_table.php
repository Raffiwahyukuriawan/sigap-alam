<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('article_approvals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('article_id')
                ->constrained('articles')
                ->cascadeOnDelete();

            $table->foreignId('admin_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('action', ['approved', 'rejected']);
            $table->text('note')->nullable();

            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_approvals');
    }
};
