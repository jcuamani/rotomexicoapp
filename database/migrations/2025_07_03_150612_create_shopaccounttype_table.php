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
        Schema::create('c_shopaccounttype', function (Blueprint $table) {
            $table->id();
            $table->string('clave', 10)->unique();
            $table->string('descr', 200);
            $table->boolean('estatus')->default(true);
            $table->string('user_create')->nullable();
            $table->string('last_user_update')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_shopaccounttype');
    }
};
