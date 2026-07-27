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
    Schema::create('order_details', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Thuộc đơn hàng nào
        $table->foreignId('book_id')->constrained('books')->onDelete('cascade'); // Mua cuốn sách nào
        $table->integer('quantity'); // Số lượng mua
        $table->decimal('price', 10, 2); // Giá tiền (lưu lại giá tại thời điểm mua)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
