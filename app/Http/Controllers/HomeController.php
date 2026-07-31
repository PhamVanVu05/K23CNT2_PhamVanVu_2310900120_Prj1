<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Lấy danh sách tất cả các danh mục
        $categories = DB::table('categories')->get();

        // 2. Khởi tạo query lấy sách
        $query = DB::table('books');

        // 3. Lọc sách theo danh mục (nếu có bấm vào menu danh mục)
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        // 4. Lọc sách theo TỪ KHÓA TÌM KIẾM (nếu có gõ vào ô search)
        if ($request->has('keyword') && $request->keyword != '') {
            $keyword = $request->keyword;
            // Tìm những cuốn sách có tên chứa từ khóa
            $query->where('title', 'LIKE', '%' . $keyword . '%');
        }

        // 5. Lấy dữ liệu sách và phân trang
        $books = $query->orderBy('created_at', 'desc')->paginate(8);

        // Giữ nguyên các tham số trên URL (cả category_id và keyword) khi chuyển trang
        $books->appends($request->all());

        return view('client.home', compact('books', 'categories'));
    }

    public function show($id)
    {
        // Lấy thông tin sách (giữ nguyên code cũ của bạn)
        $book = DB::table('books')->where('id', $id)->first();
        
        // BỔ SUNG: Lấy danh sách bình luận của cuốn sách này, join với bảng users để lấy tên
        $reviews = DB::table('reviews')
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->where('reviews.book_id', $id)
            ->select('reviews.*', 'users.name as user_name')
            ->orderBy('reviews.created_at', 'desc')
            ->get();

        // Truyền thêm biến $reviews ra view
        return view('client.book_detail', compact('book', 'reviews')); 
    }

    public function postReview(Request $request, $id)
    {
        // Kiểm tra xem khách hàng đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect()->route('client.login')->with('error', 'Bạn cần đăng nhập để gửi đánh giá!');
}

        // Validate dữ liệu
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        // Lưu đánh giá vào database
        DB::table('reviews')->insert([
            'user_id' => Auth::id(),
            'book_id' => $id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Cảm ơn bạn đã để lại đánh giá!');
    }
}