<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Hàm hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Hàm xử lý dữ liệu khi bấm nút Đăng Nhập
    public function login(Request $request)
    {
        // 1. Tìm tài khoản trong bảng admins dựa vào email
        $admin = DB::table('admins')->where('email', $request->email)->first();

        // 2. Kiểm tra tài khoản có tồn tại và mật khẩu có khớp không
        if ($admin && Hash::check($request->password, $admin->password)) {
            // Thành công: Lưu phiên đăng nhập vào Session
            Session::put('admin_id', $admin->id);
            Session::put('admin_name', $admin->name);
            
            return redirect()->route('admin.dashboard');
        }

        // Thất bại: Quay lại trang đăng nhập và đẩy ra lỗi
        return back()->with('error', 'Email hoặc mật khẩu không chính xác!');
    }
}