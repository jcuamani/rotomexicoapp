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
        Schema::create('customer_linked_bc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id'); // El que tiene linked_customers = 0
            $table->string('No',20); // Numero de cliente en BC
            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_linked_bc');
    }
};
