<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User yang memiliki cart
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Produk dalam cart
            $table->integer('quantity')->default(1); // Jumlah produk dalam cart
            $table->decimal('price', 10, 2); // Harga saat produk ditambahkan ke cart
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
