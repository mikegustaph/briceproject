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
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->enum('sex', ['male', 'female'])->default('male');
            $table->string('phone');
            $table->string('email', 100)->nullable();
            $table->string('nida_number', 20)->nullable();
            $table->string('Address', 100)->nullable();
            $table->string('District')->nullable();
            $table->string('Region', 50)->nullable();
            $table->enum('Occupation', ['Business', 'Farming', 'Job'])->default('Business');
            $table->string('customer_image', 150)->nullable();
            $table->string('customer_id_card', 150)->nullable();
            $table->decimal('credit_score', 4, 2)->default(0.5);
            $table->string('referee_one_name')->nullable();
            $table->string('referee_one_phone')->nullable();
            $table->string('referee_two_name')->nullable();
            $table->string('referee_two_phone')->nullable();
            $table->enum('status', ['Registered', 'Not_Registered', 'Banned'])->default('Not_Registered');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
