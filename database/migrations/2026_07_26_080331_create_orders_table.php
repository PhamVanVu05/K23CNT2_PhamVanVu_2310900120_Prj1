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
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Liên kết với khách hàng
        $table->string('receiver_name'); // Tên người nhận
        $table->string('receiver_phone'); // SĐT người nhận
        $table->string('receiver_address'); // Địa chỉ giao hàng
        $table->decimal('total_price', 12, 2); // Tổng tiền đơn hàng
        $table->tinyInteger('status')->default(0); // Trạng thái: 0-Chờ xử lý, 1-Đang giao, 2-Hoàn thành, 3-Đã hủy
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
