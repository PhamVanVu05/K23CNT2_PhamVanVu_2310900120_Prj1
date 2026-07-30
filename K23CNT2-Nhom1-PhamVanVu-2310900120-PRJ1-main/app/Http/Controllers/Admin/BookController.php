<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    // 1. Hiển thị danh sách các cuốn sách (Có Tìm kiếm & Phân trang)
    public function index(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ URL (nếu có)
        $search = $request->input('search');

        // Khởi tạo query cơ bản
        $query = DB::table('books')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->select('books.*', 'categories.name as category_name')
            ->orderBy('books.id', 'desc');

        // Nếu người dùng có nhập từ khóa tìm kiếm
        if ($search) {
            $query->where('books.title', 'like', '%' . $search . '%');
        }

        // Phân trang: Hiển thị 5 cuốn sách trên 1 trang (bạn có thể đổi thành 10)
        $books = $query->paginate(5);

        // Truyền dữ liệu và từ khóa tìm kiếm ra view
        return view('admin.books.index', compact('books', 'search'));
    }

    // 2. Hiển thị form thêm sách mới
    public function create()
    {
        // Lấy danh sách danh mục đang hoạt động (is_active = 1) để đổ vào thẻ <select>
        $categories = DB::table('categories')->where('is_active', 1)->get();
        
        return view('admin.books.create', compact('categories'));
    }


    // 3. Xử lý lưu sách mới vào Database
    public function store(Request $request)
    {
        // Validate dữ liệu (thêm rule kiểm tra ảnh)
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|integer',
            'author' => 'required|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // File phải là ảnh, tối đa 2MB
        ]);

        // Xử lý upload ảnh
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Lưu ảnh vào thư mục public/storage/books
            $imagePath = $request->file('image')->store('books', 'public');
        }

        // Thêm dữ liệu vào bảng books (có thêm trường image)
        DB::table('books')->insert([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'image' => $imagePath, // Lưu đường dẫn ảnh vào Database
            'author' => $request->author,
            'price' => $request->price,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Thêm sách mới thành công!');
    }

    // 4. Hiển thị form sửa sách
    public function edit($id)
    {
        $book = DB::table('books')->where('id', $id)->first();
        
        if (!$book) {
            return redirect()->route('admin.books.index')->with('error', 'Không tìm thấy sách!');
        }

        // Vẫn phải lấy danh sách danh mục để đổ vào thẻ <select> cho người dùng chọn lại
        $categories = DB::table('categories')->where('is_active', 1)->get();

        return view('admin.books.edit', compact('book', 'categories'));
    }

    // 5. Xử lý lưu dữ liệu cập nhật sách
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|integer',
            'author' => 'required|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required' => 'Vui lòng nhập tên sách.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'author.required' => 'Vui lòng nhập tác giả.',
            'price.required' => 'Vui lòng nhập giá tiền.',
        ]);

        // Tạo mảng dữ liệu cơ bản cần cập nhật
        $updateData = [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'author' => $request->author,
            'price' => $request->price,
            'description' => $request->description,
            'updated_at' => now(),
        ];

        // Nếu người dùng có upload ảnh mới
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
            $updateData['image'] = $imagePath; // Thêm đường dẫn ảnh mới vào mảng dữ liệu
        }

        DB::table('books')->where('id', $id)->update($updateData);

        return redirect()->route('admin.books.index')->with('success', 'Cập nhật sách thành công!');
    }

    // 6. Xóa sách
    public function destroy($id)
    {
        // Thực hiện xóa sách trong database
        DB::table('books')->where('id', $id)->delete();

        // Quay về trang danh sách kèm thông báo
        return redirect()->route('admin.books.index')->with('success', 'Xóa sách thành công!');
    }

    // 7. Cập nhật trạng thái Ẩn/Hiện (Active/Deactive)
    public function toggleStatus($id)
    {
        // Tìm sách theo ID
        $book = DB::table('books')->where('id', $id)->first();

        if ($book) {
            // Đảo ngược trạng thái hiện tại (1 thành 0, 0 thành 1)
            DB::table('books')->where('id', $id)->update([
                'is_active' => !$book->is_active,
                'updated_at' => now(),
            ]);
            return redirect()->back()->with('success', 'Đã cập nhật trạng thái sách!');
        }

        return redirect()->back()->with('error', 'Không tìm thấy sách!');
    }

    // 8. Xem chi tiết một cuốn sách
    public function show($id)
    {
        $book = DB::table('books')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->select('books.*', 'categories.name as category_name')
            ->where('books.id', $id)
            ->first();

        if (!$book) {
            return redirect()->route('admin.books.index')->with('error', 'Không tìm thấy sách!');
        }

        return view('admin.books.show', compact('book'));
    }
}