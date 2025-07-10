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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('idshopaccounttype');
            $table->foreign('idshopaccounttype')->references('id')->on('c_shopaccounttype');
            $table->Integer('account_role')->default(1); // 1: Regular Account, 2: Account Manager, 3. Sub-account. //para idshopaccounttype = 1 -> Customer
            $table->Integer('ono_to_one_account_relation')->default(1); // 1: One to one relation, 0: One to Multi relation. //para idshopaccounttype = 1 -> Customer
            $table->Integer('linked_customers')->default(1); // 1: Only linked customers, 0: all Customers. //para idshopaccounttype = 2-> Sales agent
            $table->Integer('can_order_products')->default(1);
            $table->Integer('can_see_prices')->default(1);
            $table->Integer('can_see_stock')->default(1);
            $table->boolean('estatus')->default(true);  // true: active, false: inactive
            $table->boolean('aproved')->default(false); // false: not approved, true: approved
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('last_web_order_at')->nullable();
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
        Schema::dropIfExists('customer');
    }
};
