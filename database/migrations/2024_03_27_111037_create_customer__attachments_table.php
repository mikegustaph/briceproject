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
        Schema::create('customer__attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->references('id')->on('customer')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('id_card_font', 100);
            $table->string('id_card_back', 100);
            $table->string('images', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer__attachments');
    }
};
