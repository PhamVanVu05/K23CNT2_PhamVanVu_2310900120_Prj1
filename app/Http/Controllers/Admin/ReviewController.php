<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    // Hiển thị danh sách đánh giá
    public function index()
    {
        // Join 3 bảng: reviews, users (để lấy tên người dùng) và books (để lấy tên sách)
        $reviews = DB::table('reviews')
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->join('books', 'reviews.book_id', '=', 'books.id')
            ->select('reviews.*', 'users.name as user_name', 'books.title as book_title')
            ->orderBy('reviews.created_at', 'desc')
            ->get();

        return view('admin.reviews.index', compact('reviews'));
    }

    // Xóa đánh giá (chống spam)
    public function destroy($id)
    {
        DB::table('reviews')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Đã xóa bình luận thành công!');
    }
}