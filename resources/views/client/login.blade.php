@extends('client.layouts.app')

@section('content')
<div class="row justify-content-center mt-5 mb-5">
    <div class="col-md-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h3 class="fw-bold text-center mb-4">Đăng Nhập Khách Hàng</h3>
                
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                <form action="{{ route('client.login.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Địa chỉ Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Nhập email của bạn..." required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Mật khẩu</label>
                        <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu..." required>
                    </div>
                    <button type="submit" class="btn btn-warning w-100 fw-bold mb-3">ĐĂNG NHẬP</button>
                    <div class="text-center">
                        <span>Chưa có tài khoản? </span>
                        <a href="{{ route('client.register') }}" class="text-decoration-none">Đăng ký ngay</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection