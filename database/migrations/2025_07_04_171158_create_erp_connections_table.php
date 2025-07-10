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
        Schema::create('erp_connections', function (Blueprint $table) {
            $table->id();
            $table->string('connection_type', 150);
            $table->string('scope_url', 255);
            $table->string('webservice_url', 255);
            $table->string('access_token_url', 255);
            $table->string('clientid', 100);
            $table->text('client_secret');
            $table->json('extra_parameters')->nullable();
            $table->integer('connection_timeout')->default(60);
            $table->boolean('estatus')->default(true);
            $table->string('user_create')->nullable();
            $table->string('last_user_update')->nullable();
            $table->timestamp('created_at')->nullable();    // fecha creación            
            $table->timestamp('updated_at')->nullable();    // fecha modificación
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('erp_connections');
    }
};
