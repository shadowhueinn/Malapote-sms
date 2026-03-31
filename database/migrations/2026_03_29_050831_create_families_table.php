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
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id')->constrained()->onDelete('cascade');
            $table->string('father_name')->nullable();
            $table->enum('father_status', ['living', 'deceased'])->default('living');
            $table->string('father_address')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('mother_name')->nullable();
            $table->enum('mother_status', ['living', 'deceased'])->default('living');
            $table->string('mother_address')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->float('total_parent_income')->default(0);
            $table->integer('number_of_siblings')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('families');
    }
};
