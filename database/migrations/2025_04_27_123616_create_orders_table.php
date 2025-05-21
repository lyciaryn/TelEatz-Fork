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
            $table->id()->autoIncrement();
            $table->foreignId('buyer_id')->references('id')->on('users');
            $table->foreignId('seller_id')->references('id')->on('users');
            $table->integer('total_price');
            $table->enum('status', ['pending', 'diproses', 'selesai', 'dibatalkan']);
            $table->enum('dine_option', ['dine-in', 'takeaway']);
            $table->enum('payment', ['qris', 'cash']);
            $table->timestamp('estimated_ready_at')->nullable();
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
