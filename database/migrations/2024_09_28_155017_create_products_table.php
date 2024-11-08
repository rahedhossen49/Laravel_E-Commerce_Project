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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->uniqid();
            $table->mediumText('short_detail')->nullable();
            $table->longText('long_detail')->nullable();
            $table->longText('additional_info')->nullable();
            $table->float('price');
            $table->float('selling_price')->nullable();
            $table->string('sku')->nullable();
            $table->integer('stock')->default(0);
            $table->string('image')->nullable();
            $table->json('cross_products')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
