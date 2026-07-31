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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Tên danh mục (Tiểu thuyết, SGK...)
            $table->string('slug')->unique(); // Đường dẫn thân thiện (tieu-thuyet)
            $table->text('description')->nullable(); // Mô tả danh mục
            $table->boolean('is_active')->default(1); // Trạng thái Active/Deactive (Buổi 4 yêu cầu)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
