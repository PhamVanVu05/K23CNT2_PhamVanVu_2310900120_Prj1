<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy danh sách các cuốn sách để hiển thị ra trang chủ (mỗi trang 8 cuốn)
        $books = DB::table('books')
            // Giả sử sau này bạn có cột is_active để ẩn/hiện sách, nếu chưa có thì bỏ dòng where này đi nhé
            // ->where('is_active', 1) 
            ->orderBy('id', 'desc')
            ->paginate(8);

        return view('client.home', compact('books'));
    }
}