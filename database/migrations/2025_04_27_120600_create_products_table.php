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
            $table->id()->autoIncrement();
            $table->foreignId('seller_id')->nullable()->references('id')->on('users')->constrained('users');
            $table->string('nama_product');
            $table->integer('harga')->unsigned();
            $table->text('deskripsi');
            $table->boolean('is_available')->default(true);
            $table->foreignId('category_id')->nullable()->references('id')->on('categories')->nullOnDelete();
            $table->string('img')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
