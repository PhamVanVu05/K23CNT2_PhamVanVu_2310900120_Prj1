<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Trí Tuệ Bookstore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar { height: 100vh; background-color: #343a40; padding-top: 20px; }
        .sidebar a { color: white; padding: 10px 15px; display: block; text-decoration: none; }
        .sidebar a:hover { background-color: #495057; }
        .content { padding: 20px; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Cột Menu bên trái (Sidebar) -->
            <div class="col-md-2 sidebar">
                <h5 class="text-white text-center mb-4">TRÍ TUỆ BOOKSTORE</h5>
                <a href="{{ route('admin.dashboard') }}">Bảng điều khiển</a>
                <a href="{{ route('admin.categories.index') }}">Quản lý Danh mục</a>
                <a href="{{ route('admin.books.index') }}">Quản lý Sách</a>
                <a href="{{ route('admin.orders.index') }}">Quản lý Đơn hàng</a>
                <a href="{{ route('admin.users.index') }}">Quản lý Khách hàng</a>
                <hr class="text-white">
                <a href="#" class="text-danger">Đăng xuất</a>
            </div>
            
            <!-- Cột Nội dung chính bên phải -->
            <div class="col-md-10 content">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>