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

            // 商品所属分类 ID
            $table->foreignId('category_id')
                ->constrained('categories')
                ->restrictOnDelete();

            // 商品名称
            $table->string('name', 100);

            // 商品描述
            $table->text('description')->nullable();

            // 商品价格
            $table->decimal('price', 10, 2);

            // 商品库存
            $table->unsignedInteger('stock')->default(0);

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
