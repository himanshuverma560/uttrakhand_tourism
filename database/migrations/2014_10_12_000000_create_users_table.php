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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile')->unique();
            $table->string('country_code')->default('+91');
            $table->string('email')->unique();
            $table->enum('pilgrim_type', ['Indian Pilgrim', 'Foreign Pilgrim'])->default('Indian Pilgrim');
            $table->enum('user_type', ['Tour Operator', 'Individual', 'Family'])->default('Individual');
            $table->string('company_name')->nullable();
            $table->string('gst_number')->nullable();
            $table->string('state')->nullable();
            $table->string('password');
            $table->string('original_password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
