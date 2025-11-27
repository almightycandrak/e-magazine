<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->text('review_notes')->nullable()->after('status');
            $table->timestamp('reviewed_at')->nullable()->after('review_notes');
            $table->unsignedBigInteger('reviewed_by')->nullable()->after('reviewed_at');
            
            $table->foreign('reviewed_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->dropForeign(['reviewed_by']);
            $table->dropColumn(['review_notes', 'reviewed_at', 'reviewed_by']);
        });
    }
};