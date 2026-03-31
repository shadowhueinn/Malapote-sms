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
        Schema::table('applicants', function (Blueprint $table) {
            $table->string('middle_name')->nullable()->after('first_name');
            $table->string('maiden_name')->nullable()->after('last_name');
            $table->string('place_of_birth')->nullable()->after('birthdate');
            $table->enum('sex', ['Male', 'Female'])->after('place_of_birth');
            $table->string('citizenship')->default('Filipino')->after('sex');
            $table->string('school_id')->nullable()->after('school');
            $table->string('school_address')->nullable()->after('school_id');
            $table->enum('school_sector', ['public', 'private'])->after('school_address');
            $table->string('year_level')->after('school_sector');
            $table->string('tribal_membership')->nullable()->after('year_level');
            $table->string('disability_type')->nullable()->after('tribal_membership');
            $table->boolean('has_other_assistance')->default(false)->after('gpa');
            $table->string('assistance_1')->nullable()->after('has_other_assistance');
            $table->string('assistance_2')->nullable()->after('assistance_1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            //
        });
    }
};
