<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // Hiển thị danh sách danh mục
    public function index()
    {
        $categories = DB::table('categories')->orderBy('id', 'desc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    // Hiển thị form thêm mới
    public function create()
    {
        return view('admin.categories.create');
    }

    // Xử lý lưu dữ liệu vào Database
    public function store(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào (Validation)
        $request->validate([
            'name' => 'required|max:255',
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục',
        ]);

        // Insert vào bảng categories
        DB::table('categories')->insert([
            'name' => $request->name,
            'slug' => Str::slug($request->name), // Tạo slug từ tên danh mục
            'description' => $request->description,
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Trở về trang danh sách và báo thành công
        return redirect()->route('admin.categories.index')->with('success', 'Thêm danh mục thành công!');
    }

    // PHẦN MỚI THÊM VÀO ĐỂ XỬ LÝ CHỨC NĂNG SỬA

    // Hiển thị form sửa
    public function edit($id)
    {
        // Lấy thông tin danh mục cần sửa
        $category = DB::table('categories')->where('id', $id)->first();

        if (!$category) {
            return redirect()->route('admin.categories.index')->with('error', 'Không tìm thấy danh mục!');
        }

        return view('admin.categories.edit', compact('category'));
    }

    // Xử lý lưu dữ liệu cập nhật
    public function update(Request $request, $id)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục.',
            'slug.required' => 'Vui lòng nhập đường dẫn tĩnh (slug).',
        ]);

        // Cập nhật vào Database
        DB::table('categories')->where('id', $id)->update([
            'name' => $request->name,
            'slug' => $request->slug, // Lấy slug từ form sửa
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'updated_at' => now(),
        ]);

        // Quay về trang danh sách kèm thông báo
        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật danh mục thành công!');
    }
    // Xóa danh mục
    public function destroy($id)
    {
        // Thực hiện lệnh xóa trong database
        DB::table('categories')->where('id', $id)->delete();

        // Quay về trang danh sách kèm thông báo
        return redirect()->route('admin.categories.index')->with('success', 'Xóa danh mục thành công!');
    }
}