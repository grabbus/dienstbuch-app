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
        Schema::table('members', function (Blueprint $table) {
            $table->string('school_name')->after('nationality')->nullable();
            $table->string('class_name')->after('school_name')->nullable();
            $table->string('other_clubs_and_organisations')->after('class_name')->nullable();
            $table->boolean('is_swimmer')->after('other_clubs_and_organisations')->nullable();
            $table->string('health_insurance')->after('is_swimmer')->nullable();
            $table->string('physical_limitations')->after('health_insurance')->nullable();
            $table->string('shoe_size')->after('physical_limitations')->nullable();
            $table->string('size')->after('shoe_size')->nullable();
            $table->boolean('is_glasses_wearer')->after('size')->nullable();
            $table->boolean('accepted_data_protection_rules')->after('is_glasses_wearer')->nullable();
            $table->boolean('given_image_rights')->after('accepted_data_protection_rules')->nullable();
            $table->boolean('accepted_data_protection_database')->after('given_image_rights')->nullable();
            $table->string('pick_up_permissions')->after('accepted_data_protection_database')->nullable();
            $table->boolean('admission_organization')->after('pick_up_permissions')->nullable();
            $table->boolean('admission_fire_department')->after('admission_organization')->nullable();
            $table->date('date_admission')->after('admission_fire_department')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn([
                'school_name',
                'class_name',
                'other_clubs_and_organisations',
                'is_swimmer',
                'health_insurance',
                'physical_limitations',
                'shoe_size',
                'size',
                'is_glasses_wearer',
                'accepted_data_protection_rules',
                'given_image_rights',
                'accepted_data_protection_database',
                'pick_up_permissions',
                'admission_organization',
                'admission_fire_department',
                'date_admission',
            ]);
        });
    }
};
