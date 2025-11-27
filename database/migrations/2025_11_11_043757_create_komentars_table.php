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
        Schema::create('komentars', function (Blueprint $table) {
            $table->id();
            $table->text('isi');
            $table->unsignedBigInteger('id_artikel');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            $table->foreign('id_artikel')->references('id')->on('artikels')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentars');
    }
};
