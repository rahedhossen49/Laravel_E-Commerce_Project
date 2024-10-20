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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
        $table->foreignId('customer_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
        $table->string('name');
        $table->string('email')->nullable();
        $table->string('phone');
        $table->float('amount')->default(0); // Corrected spelling
        $table->mediumText('address');
        $table->mediumText('address2')->nullable();
        $table->enum('status', ['Processing', 'Complete', 'Pending', 'Delivering', 'Delivered']);
        $table->string('transaction_id')->unique();
        $table->string('state')->default('chittagong');
        $table->string('currency')->default('BTD');
        $table->string('country')->default('bangladesh');
        $table->string('zip')->nullable();
        $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
