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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Khóa ngoại liên kết danh mục
            $table->string('title'); // Tên sách
            $table->string('author')->nullable(); // Tác giả
            $table->string('image')->nullable(); // Ảnh bìa sách
            $table->decimal('price', 10, 2); // Giá tiền
            $table->integer('quantity')->default(0); // Số lượng tồn kho
            $table->text('description')->nullable(); // Mô tả sách
            $table->boolean('is_active')->default(1); // Trạng thái Ẩn/Hiện
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
