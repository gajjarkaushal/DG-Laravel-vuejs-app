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
        Schema::create('installers', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('business_name'); // Business name
            $table->string('url')->unique(); // URL (auto-generated and unique)
            $table->string('email')->unique(); // Email address (unique)
            $table->string('phone_number'); // Phone number
            $table->string('website_url')->nullable(); // Website URL (nullable)
            $table->string('address_1'); // Address 1
            $table->string('address_2')->nullable(); // Address 2 (nullable)
            $table->string('city'); // City
            $table->string('county')->nullable(); // County (nullable)
            $table->string('postcode'); // Postcode
            $table->enum('status', ['Pending', 'Active', 'Disabled'])->default('Pending'); // Status (select input)
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
