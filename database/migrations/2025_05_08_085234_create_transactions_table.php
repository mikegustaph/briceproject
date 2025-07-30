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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('loan_id')->constrained('loan')->onDelete('cascade');
            $table->foreignId('loan_id')->constrained('loan')->onDelete('cascade');
            $table->string('accountNumber', 125);
            $table->string('amount', 125);
            $table->string('currency', 3)->default('TZS');
            $table->string('externalId')->unique();
            $table->string('provider');
            $table->enum('status', ['Success', 'Initiated', 'Failed'])->default('Initiated');
            $table->json('additional_properties')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
