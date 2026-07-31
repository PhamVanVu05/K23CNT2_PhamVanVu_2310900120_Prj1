@extends('client.layouts.app')

@section('content')
<div class="row justify-content-center mt-5 mb-5">
    <div class="col-md-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h3 class="fw-bold text-center mb-4">Đăng Ký Tài Khoản</h3>
                
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('client.register.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Họ và Tên</label>
                        <input type="text" name="name" class="form-control" placeholder="Nhập họ tên..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Địa chỉ Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Nhập email..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Mật khẩu</label>
                        <input type="password" name="password" class="form-control" placeholder="Tạo mật khẩu (ít nhất 6 ký tự)..." required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Xác nhận mật khẩu</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu..." required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 fw-bold mb-3">ĐĂNG KÝ</button>
                    <div class="text-center">
                        <span>Đã có tài khoản? </span>
                        <a href="{{ route('client.login') }}" class="text-decoration-none">Đăng nhập ngay</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection