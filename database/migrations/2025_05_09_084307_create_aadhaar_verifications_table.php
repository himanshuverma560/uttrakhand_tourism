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
        Schema::create('aadhaar_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('request_id')->unique();
            $table->string('aadhaar_number')->nullable();
            $table->string('name')->nullable();
            $table->string('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();  // Store the address as text
            $table->string('state')->nullable();
            $table->string('district')->nullable();
            $table->string('pincode')->nullable();
            $table->string('profile_image_path')->nullable(); // path to stored image
            $table->json('raw_response')->nullable(); // store full API response
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aadhaar_verifications');
    }
};
