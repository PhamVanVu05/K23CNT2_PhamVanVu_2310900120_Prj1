<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Thêm thư viện Auth
use Illuminate\Support\Facades\DB; // Thêm thư viện DB

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        // Tính tạm tính
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // Tính tiền giảm giá nếu có Session coupon
        $discountAmount = 0;
        if (session()->has('coupon')) {
            $discountAmount = ($subtotal * session('coupon')['percent']) / 100;
        }

        $total = $subtotal - $discountAmount;

        return view('client.checkout', compact('cart', 'subtotal', 'discountAmount', 'total'));
    }

// 2. THÊM HÀM ÁP DỤNG MÃ
    public function applyCoupon(Request $request)
    {
        $couponCode = trim($request->coupon_code);
        
        // Tìm mã trong DB
        $coupon = DB::table('coupons')->where('code', $couponCode)->first();

        if (!$coupon) {
            return redirect()->back()->with('error', 'Mã giảm giá không tồn tại hoặc đã hết hạn!');
        }

        // Lưu thông tin mã vào Session
        session()->put('coupon', [
            'code' => $coupon->code,
            'percent' => $coupon->discount_percent
        ]);

        return redirect()->back()->with('success', 'Đã áp dụng mã giảm giá thành công!');
    }

    // 3. THÊM HÀM HỦY MÃ
    public function removeCoupon()
    {
        session()->forget('coupon');
        return redirect()->back()->with('success', 'Đã hủy mã giảm giá!');
    }

    // 4. CẬP NHẬT HÀM PROCESS (Lưu đơn hàng)
    public function process(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('home');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // Tính tổng tiền thực tế sau khi trừ mã giảm giá để lưu vào DB
        $totalAmount = $subtotal;
        if (session()->has('coupon')) {
            $discountAmount = ($subtotal * session('coupon')['percent']) / 100;
            $totalAmount = $subtotal - $discountAmount;
        }

        $orderId = DB::table('orders')->insertGetId([
            'user_id' => Auth::check() ? Auth::id() : null,
            'customer_name' => $request->name,
            'customer_phone' => $request->phone,
            'address' => $request->address,      
            'total_price' => $totalAmount,       
            'status' => 0,                       
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach ($cart as $bookId => $item) {
            DB::table('order_details')->insert([
                'order_id' => $orderId,
                'book_id' => $bookId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Đặt hàng xong thì xóa giỏ hàng VÀ xóa luôn mã giảm giá đang lưu
        session()->forget(['cart', 'coupon']);

        return redirect()->route('home')->with('success', 'Chúc mừng bạn đã đặt hàng thành công!');
    }

    // Hàm hiển thị Lịch sử mua hàng
    public function history()
    {
        // Lấy các đơn hàng thuộc về user đang đăng nhập, sắp xếp mới nhất lên đầu
        $orders = DB::table('orders')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('client.history', compact('orders'));
    }
}