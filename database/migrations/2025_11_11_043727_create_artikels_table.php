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
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi');
            $table->date('tanggal');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_kategori');
            $table->string('foto')->nullable();
            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_kategori')->references('id')->on('kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikels');
    }
};
