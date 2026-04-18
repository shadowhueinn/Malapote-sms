<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scholarship_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('maiden_name')->nullable();
            $table->date('birthdate');
            $table->enum('sex', ['male', 'female', 'other']);
            $table->enum('civil_status', ['single', 'married', 'widowed', 'separated', 'other']);
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->string('street')->nullable();
            $table->string('barangay')->nullable();
            $table->string('municipality')->nullable();
            $table->string('province')->nullable();
            $table->string('region')->nullable();
            $table->string('school_id')->nullable();
            $table->string('year_level')->nullable();
            $table->string('tribal_membership')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->decimal('household_income', 12, 2)->nullable();
            $table->boolean('is_indigent')->default(false);
            $table->boolean('has_cor')->default(false);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scholarship_applications');
    }
};
