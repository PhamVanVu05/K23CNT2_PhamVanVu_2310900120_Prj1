<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        // 1. Tạo tài khoản Admin mặc định
        
        DB::table('admins')->insert([
            'name' => 'Quản trị viên',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        

        // 2. Tạo dữ liệu mẫu cho bảng Categories (Danh mục)
        
        $categories = [
            'Sách Lập trình Web', 
            'Sách Ngoại ngữ', 
            'Tiểu thuyết Văn học', 
            'Sách Kinh tế'
        ];

        foreach ($categories as $cat) {
            DB::table('categories')->insert([
                'name' => $cat,
                'slug' => Str::slug($cat),
                'description' => 'Đây là danh mục chứa các đầu ' . $cat,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        // 3. Tạo 10 tài khoản khách hàng giả (Thêm mới vào đây)
        \App\Models\User::factory(10)->create();
    }
}