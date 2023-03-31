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
        Schema::create('orders_items', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->integer('inventory_id');
            $table->integer('variant_id')->nullable();
            $table->text('laber_item')->nullable();
            $table->integer('quantity')->default(1);
            $table->integer('discount_status')->default(0);
            $table->integer('discount')->default(0);
            $table->decimal('price_unit',11,2);
            $table->decimal('total',11,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_items');
    }
};
