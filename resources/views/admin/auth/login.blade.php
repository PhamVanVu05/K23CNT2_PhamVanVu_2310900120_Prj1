<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Trí Tuệ Bookstore</title>
    <!-- Nhúng thư viện Bootstrap để có giao diện đẹp ngay lập tức -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        .login-box { margin-top: 100px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 login-box">
                <div class="card shadow">
                    <div class="card-header text-center bg-primary text-white">
                        <h4>TRÍ TUỆ BOOKSTORE</h4>
                        <p class="mb-0">Đăng nhập hệ thống quản trị</p>
                    </div>
                    <div class="card-body p-4">
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <form action="{{ route('admin.login.post') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email đăng nhập</label>
                                <input type="email" name="email" class="form-control" placeholder="Nhập email..." required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mật khẩu</label>
                                <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu..." required>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary">Đăng Nhập</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>