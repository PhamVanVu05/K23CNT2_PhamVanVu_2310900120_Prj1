<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Tính tổng doanh thu (Chỉ tính các đơn hàng Đã hoàn thành - status = 3)
        $totalRevenue = DB::table('orders')->where('status', 3)->sum('total_price');

        // 2. Đếm tổng số đơn hàng đã đặt
        $totalOrders = DB::table('orders')->count();

        // 3. Đếm tổng số lượng khách hàng
        $totalCustomers = DB::table('users')->count();

        // 4. Đếm tổng số đầu sách đang bán
        $totalBooks = DB::table('books')->count();

        // Trả các biến này về cho View
        return view('admin.dashboard', compact('totalRevenue', 'totalOrders', 'totalCustomers', 'totalBooks'));
    }
}