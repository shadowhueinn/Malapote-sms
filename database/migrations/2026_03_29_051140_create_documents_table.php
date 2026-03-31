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
        // This migration is redundant with a prior `create_documents_table` migration.
        // Skip creation if the table already exists to allow `migrate:fresh` to run.
        if (Schema::hasTable('documents')) {
            return;
        }

        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op: this migration may have been skipped if `documents` already existed.
    }
};
