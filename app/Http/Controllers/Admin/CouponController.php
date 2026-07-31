<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    // Hiển thị danh sách mã giảm giá
    public function index()
    {
        $coupons = DB::table('coupons')->orderBy('created_at', 'desc')->get();
        return view('admin.coupons.index', compact('coupons'));
    }

    // Xử lý thêm mã giảm giá mới
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code',
            'discount_percent' => 'required|integer|min:1|max:100',
        ], [
            'code.unique' => 'Mã giảm giá này đã tồn tại!',
            'discount_percent.max' => 'Phần trăm giảm tối đa là 100%',
        ]);

        DB::table('coupons')->insert([
            'code' => strtoupper($request->code), // Tự động viết hoa mã
            'discount_percent' => $request->discount_percent,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Thêm mã giảm giá thành công!');
    }

    // Xóa mã giảm giá
    public function destroy($id)
    {
        DB::table('coupons')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Đã xóa mã giảm giá!');
    }
}