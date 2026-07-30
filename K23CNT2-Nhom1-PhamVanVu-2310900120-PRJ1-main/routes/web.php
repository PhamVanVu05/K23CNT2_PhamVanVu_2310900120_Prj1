<?php

use Illuminate\Support\Facades\Route;

// Trang chủ Khách hàng
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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

});