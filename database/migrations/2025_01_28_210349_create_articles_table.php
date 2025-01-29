<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('author')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->string('source');
            $table->string('category')->nullable();
            $table->string('url');
            $table->string('image_url')->nullable();
            $table->timestamp('published_at');
            $table->timestamps();

            $table->index('title');
            $table->index('author');
            $table->index('source');
            $table->index('category');
            $table->fullText('content');
            $table->fullText('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
