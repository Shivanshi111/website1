<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('subcategory_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subcategory_id')->constrained()->onDelete('cascade');  // Ensure it's named subcategory_id
            $table->string('locale');  // Language code, e.g., 'en', 'hi', 'pa'
            $table->string('name');    // Translated subcategory name
            $table->timestamps();
            $table->unique(['subcategory_id', 'locale']);
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategory_translations');
    }
};

