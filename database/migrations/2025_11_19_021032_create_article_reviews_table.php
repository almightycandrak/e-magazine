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
        Schema::create('article_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artikel_id')->constrained('artikels')->onDelete('cascade');
            $table->foreignId('reviewer_id')->constrained('users');
            $table->foreignId('author_id')->constrained('users');
            $table->string('artikel_title');
            $table->enum('action', ['approved', 'rejected', 'revision']);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_reviews');
    }
};
