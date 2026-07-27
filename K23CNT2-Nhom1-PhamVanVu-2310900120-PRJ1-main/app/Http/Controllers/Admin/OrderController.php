<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status'); // Lọc theo trạng thái

        $query = DB::table('orders')->orderBy('id', 'desc');

        // Lọc theo tên hoặc số điện thoại khách
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('customer_name', 'like', '%' . $search . '%')
                  ->orWhere('customer_phone', 'like', '%' . $search . '%');
            });
        }

        // Lọc theo trạng thái (nếu có chọn)
        if ($status !== null) {
            $query->where('status', $status);
        }

        $orders = $query->paginate(10);

        return view('admin.orders.index', compact('orders', 'search', 'status'));
    }

    // Xem chi tiết đơn hàng
    public function show($id)
    {
        // 1. Lấy thông tin chung của đơn hàng
        $order = DB::table('orders')->where('id', $id)->first();

        if (!$order) {
            return redirect()->route('admin.orders.index')->with('error', 'Không tìm thấy đơn hàng!');
        }

        // 2. Lấy danh sách các cuốn sách trong đơn hàng này
        $orderDetails = DB::table('order_details')
            ->join('books', 'order_details.book_id', '=', 'books.id')
            ->where('order_details.order_id', $id)
            ->select('order_details.*', 'books.title', 'books.image')
            ->get();

        return view('admin.orders.show', compact('order', 'orderDetails'));
    }

    // Cập nhật trạng thái đơn hàng
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|integer|between:0,4',
        ]);

        DB::table('orders')->where('id', $id)->update([
            'status' => $request->status,
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}