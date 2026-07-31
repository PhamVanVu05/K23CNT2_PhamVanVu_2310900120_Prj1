<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // 1. Hiển thị danh sách khách hàng
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = DB::table('users')->orderBy('id', 'desc');

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
        }

        $users = $query->paginate(10); // Hiển thị 10 khách hàng/trang

        return view('admin.users.index', compact('users', 'search'));
    }

    // 2. Xem chi tiết khách hàng
    public function show($id)
    {
        $user = DB::table('users')->where('id', $id)->first();

        if (!$user) {
            return redirect()->route('admin.users.index')->with('error', 'Không tìm thấy khách hàng!');
        }

        return view('admin.users.show', compact('user'));
    }
}