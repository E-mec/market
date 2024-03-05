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
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sub_category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained()->cascadeOnDelete();
            $table->foreignId('range_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->longText('description');
            $table->string('meta_title');
            $table->string('meta_keyword');
            $table->longText('meta_description');
            $table->integer('quantity');
            $table->integer('old_price')->nullable();
            $table->integer('new_price');
            $table->integer('discount')->nullable();
            $table->boolean('is_available' )->default(true);
            $table->boolean('hot')->default(false);
            $table->boolean('trending')->default(false);
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
