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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // To link the cart to a user
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Linking each cart item to a product
            $table->string('image'); // To store the product's image path
            $table->decimal('price', 10, 2); // To store the product price
            $table->integer('quantity')->default(1); // To store the quantity of the product in the cart
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
