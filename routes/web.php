<?php

use Illuminate\Support\Facades\Route;

// Trang chủ Khách hàng
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Trang chi tiết sách
    Route::get('/sach/{id}', [App\Http\Controllers\HomeController::class, 'show'])->name('book.detail');

// Route xử lý Giỏ hàng
    Route::post('/cart/add/{id}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/remove/{id}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

// Route xử lý Thanh toán (Checkout)
    Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');

// Route hiển thị form thanh toán
    Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');

// Route xử lý việc lưu đơn hàng khi bấm nút "XÁC NHẬN ĐẶT HÀNG"
    Route::post('/checkout/process', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');

// Đăng nhập / Đăng ký Khách hàng
    Route::get('/dang-nhap', [App\Http\Controllers\ClientAuthController::class, 'showLogin'])->name('client.login');
    Route::post('/dang-nhap', [App\Http\Controllers\ClientAuthController::class, 'login'])->name('client.login.post');

    Route::get('/dang-ky', [App\Http\Controllers\ClientAuthController::class, 'showRegister'])->name('client.register');
    Route::post('/dang-ky', [App\Http\Controllers\ClientAuthController::class, 'register'])->name('client.register.post');

    Route::post('/dang-xuat', [App\Http\Controllers\ClientAuthController::class, 'logout'])->name('client.logout');

// Route Lịch sử mua hàng (Bắt buộc đăng nhập)
    Route::get('/lich-su-mua-hang', [App\Http\Controllers\CheckoutController::class, 'history'])
    ->name('client.history')
    ->middleware('auth');

// Route xử lý mã giảm giá
    Route::post('/checkout/apply-coupon', [App\Http\Controllers\CheckoutController::class, 'applyCoupon'])->name('checkout.apply-coupon');
    Route::post('/checkout/remove-coupon', [App\Http\Controllers\CheckoutController::class, 'removeCoupon'])->name('checkout.remove-coupon');
    
// Route xử lý gửi đánh giá (Yêu cầu id của cuốn sách)
    Route::post('/sach/{id}/review', [App\Http\Controllers\HomeController::class, 'postReview'])->name('book.review');

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;

// Route cho phần Admin
Route::prefix('admin')->group(function () {

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.post');

    // Bảng điều khiển (Dashboard) - Đã chuyển Route chuẩn lên đây và dùng Controller
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    // Quản lý Danh mục
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // ============================
    // QUẢN LÝ SÁCH (BOOKS)
    // ============================
    Route::get('/books', [App\Http\Controllers\Admin\BookController::class, 'index'])->name('admin.books.index');
    Route::get('/books/create', [App\Http\Controllers\Admin\BookController::class, 'create'])->name('admin.books.create');
    Route::post('/books/store', [App\Http\Controllers\Admin\BookController::class, 'store'])->name('admin.books.store');
    Route::get('/books/{id}/edit', [App\Http\Controllers\Admin\BookController::class, 'edit'])->name('admin.books.edit');
    Route::put('/books/{id}', [App\Http\Controllers\Admin\BookController::class, 'update'])->name('admin.books.update');
    Route::delete('/books/{id}', [App\Http\Controllers\Admin\BookController::class, 'destroy'])->name('admin.books.destroy');
    Route::patch('/books/{id}/toggle-status', [App\Http\Controllers\Admin\BookController::class, 'toggleStatus'])->name('admin.books.toggle-status');
    Route::get('/books/{id}', [App\Http\Controllers\Admin\BookController::class, 'show'])->name('admin.books.show');

    // ============================
    // QUẢN LÝ KHÁCH HÀNG
    // ============================
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{id}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.users.show');

    // ============================
    // QUẢN LÝ ĐƠN HÀNG
    // ============================
    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{id}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/orders/{id}/status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('admin.orders.update_status');

    // Quản lý Mã giảm giá
    Route::get('/coupons', [App\Http\Controllers\Admin\CouponController::class, 'index'])->name('admin.coupons.index');
    Route::post('/coupons', [App\Http\Controllers\Admin\CouponController::class, 'store'])->name('admin.coupons.store');
    Route::delete('/coupons/{id}', [App\Http\Controllers\Admin\CouponController::class, 'destroy'])->name('admin.coupons.destroy');

    // Quản lý Đánh giá & Bình luận
    Route::get('/reviews', [App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('admin.reviews.index');
    Route::delete('/reviews/{id}', [App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('admin.reviews.destroy');
});