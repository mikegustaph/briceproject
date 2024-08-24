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
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->enum('sex', ['male', 'female'])->default('male');
            $table->date('Date_of_birth');
            $table->string('phone');
            $table->string('email', 100)->unique()->nullable();
            $table->string('nida_number', 20);
            $table->string('region', 50);
            $table->string('address', 100);
            $table->string('current_location', 100);
            $table->enum('Education', ['Kinder garten', 'Primary school', 'Seconday school', 'High school', 'Diploma/Certificate', 'Bachelor Degree', 'Master Degree', 'Doctorate Degree/PHD', 'Other']);
            $table->enum('Marital_status', ['Single', 'Married', 'Divorced', 'Widowed']);
            $table->string('Address');
            $table->string('district');
            $table->string('Region');
            $table->string('Exist_loan');
            $table->string('customer_image', 150)->nullable();
            $table->string('customer_id_card', 150)->nullable();
            //$table->enum('Work_status', ['Business', ]);
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
