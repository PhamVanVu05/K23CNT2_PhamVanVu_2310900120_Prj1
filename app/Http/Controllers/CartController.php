<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // Thêm sản phẩm vào giỏ hàng
    public function add(Request $request, $id)
    {
        $book = DB::table('books')->where('id', $id)->first();
        
        if (!$book) {
            return redirect()->back()->with('error', 'Không tìm thấy sách!');
        }

        // Lấy giỏ hàng hiện tại từ Session (nếu chưa có thì tạo mảng rỗng)
        $cart = session()->get('cart', []);
        $quantity = $request->quantity ?? 1;

        // Nếu sách đã có trong giỏ -> cộng dồn số lượng
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            // Nếu chưa có -> thêm mới vào mảng
            $cart[$id] = [
                'title' => $book->title,
                'price' => $book->price,
                'image' => $book->image,
                'quantity' => $quantity
            ];
        }

        // Cập nhật lại Session
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Đã thêm sách vào giỏ hàng!');
    }

    // Hiển thị trang Giỏ hàng
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('client.cart', compact('cart'));
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function remove($id)
    {
        $cart = session()->get('cart');
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Đã xóa sách khỏi giỏ hàng!');
    }
}