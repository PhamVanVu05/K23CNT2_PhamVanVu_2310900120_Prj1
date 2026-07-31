<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trí Tuệ Bookstore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .book-card img { height: 250px; object-fit: cover; }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">TRÍ TUỆ BOOKSTORE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Danh mục</a></li>
                </ul>
                <!-- Form tìm kiếm sách -->
                <form class="d-flex me-4" action="{{ route('home') }}" method="GET">
                    <input class="form-control me-2" type="search" name="keyword" placeholder="Tìm tên sách..." value="{{ request('keyword') }}" aria-label="Search">
                    <button class="btn btn-outline-light w-50" type="submit">Tìm</button>
                </form>
                <div class="d-flex align-items-center">
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-light me-3">
                        Giỏ hàng ({{ session('cart') ? count(session('cart')) : 0 }})
                    </a>
                    
                    @auth
                        <!-- Nếu đã đăng nhập -->
                        <div class="dropdown">
                            <button class="btn btn-warning dropdown-toggle fw-bold" type="button" data-bs-toggle="dropdown">
                                Xin chào, {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('client.history') }}">Lịch sử mua hàng</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('client.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Đăng xuất</button>
                                    </form>
                                </li>
                            </ul>
                            </ul>
                        </div>
                        @else
                            <!-- Nếu chưa đăng nhập -->
                            <a href="{{ route('client.login') }}" class="btn btn-warning me-2">Đăng nhập</a>
                            <a href="{{ route('client.register') }}" class="btn btn-outline-light">Đăng ký</a>
                        @endauth
                    </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container min-vh-100">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p class="mb-0">&copy; 2026 Trí Tuệ Bookstore. Nền tảng kinh doanh sách trực tuyến.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>