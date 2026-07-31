<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Đơn hàng 1: Chờ xử lý (status = 0)
        $order1 = DB::table('orders')->insertGetId([
            'user_id' => 1,
            'customer_name' => 'Lucious Murray',
            'customer_phone' => '0987654321',
            'address' => 'Số 1, Đường Cầu Giấy, Hà Nội',
            'total_price' => 420000,
            'status' => 0,
            'created_at' => Carbon::now()->subDays(2),
            'updated_at' => Carbon::now()->subDays(2),
        ]);

        DB::table('order_details')->insert([
            ['order_id' => $order1, 'book_id' => 1, 'quantity' => 1, 'price' => 210000, 'created_at' => now(), 'updated_at' => now()],
            ['order_id' => $order1, 'book_id' => 4, 'quantity' => 1, 'price' => 210000, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Đơn hàng 2: Đang giao (status = 2)
        $order2 = DB::table('orders')->insertGetId([
            'user_id' => 2,
            'customer_name' => 'Maggie Ruecker',
            'customer_phone' => '0123999888',
            'address' => 'Quận 1, TP. Hồ Chí Minh',
            'total_price' => 150000,
            'status' => 2,
            'created_at' => Carbon::now()->subDay(),
            'updated_at' => Carbon::now()->subDay(),
        ]);

        DB::table('order_details')->insert([
            ['order_id' => $order2, 'book_id' => 3, 'quantity' => 1, 'price' => 150000, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Đơn hàng 3: Đã hoàn thành (status = 3)
        $order3 = DB::table('orders')->insertGetId([
            'user_id' => 3,
            'customer_name' => 'Cornell Walker',
            'customer_phone' => '0555777666',
            'address' => 'Đà Nẵng',
            'total_price' => 420000,
            'status' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('order_details')->insert([
            ['order_id' => $order3, 'book_id' => 4, 'quantity' => 2, 'price' => 210000, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}