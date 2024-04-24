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
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->dateTime('birthday');
            $table->string('phone');
            $table->enum('sex', ['male', 'female'])->default('male');
            $table->enum('position', ['Loan Officer', 'Salesperson', 'Secretary',])->default('Loan Officer');
            $table->string('cv', 100);
            $table->string('address');
            $table->foreignId('role_id');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile_image');
            $table->enum('status', ['Active', 'Inactive', 'Suspended'])->default('Active');
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
