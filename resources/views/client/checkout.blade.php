@extends('client.layouts.app')

@section('content')
<div class="row mt-4 mb-5">
    <!-- Cột bên trái: Form thông tin khách hàng -->
    <div class="col-md-7">
        <h3 class="fw-bold mb-4">Thông tin giao hàng</h3>
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <!-- Action tạm thời để #, chúng ta sẽ xử lý lưu đơn hàng sau -->
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Họ và tên người nhận <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Nhập họ và tên..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Số điện thoại <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại..." required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Địa chỉ giao hàng chi tiết <span class="text-danger">*</span></label>
                        <textarea name="address" class="form-control" rows="3" placeholder="Nhập số nhà, tên đường, phường/xã, quận/huyện..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success btn-lg w-100 fw-bold">XÁC NHẬN ĐẶT HÀNG</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Cột bên phải: Tóm tắt đơn hàng -->
    <div class="col-md-5">
        <h4 class="fw-bold mb-4">Tóm tắt đơn hàng</h4>
        <div class="card shadow-sm border-0 bg-light">
            <div class="card-body p-4">
                
                @foreach($cart as $item)
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('storage/' . $item['image']) }}" width="50" class="me-3 rounded" alt="book">
                            <div>
                                <h6 class="mb-0 fw-bold">{{ $item['title'] }}</h6>
                                <small class="text-muted">Số lượng: {{ $item['quantity'] }}</small>
                            </div>
                        </div>
                        <span class="fw-bold text-danger">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} đ</span>
                    </div>
                @endforeach
                
                <!-- Khu vực nhập mã giảm giá -->
                <div class="mt-4 border-top pt-3">
                    <form action="{{ route('checkout.apply-coupon') }}" method="POST" class="mb-3">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="coupon_code" class="form-control" placeholder="Nhập mã giảm giá (vd: NOEL20)..." value="{{ session('coupon')['code'] ?? '' }}" required>
                            <button class="btn btn-primary" type="submit">Áp dụng</button>
                        </div>
                    </form>

                    <!-- Thông báo xử lý mã -->
                    @if(session('error'))
                        <div class="alert alert-danger py-2 mb-3"><small>{{ session('error') }}</small></div>
                    @endif

                    <!-- Hiển thị mã đang áp dụng -->
                    @if(session('coupon'))
                        <div class="alert alert-success py-2 d-flex justify-content-between align-items-center mb-3">
                            <span>Đang áp dụng: <strong>{{ session('coupon')['code'] }}</strong> (-{{ session('coupon')['percent'] }}%)</span>
                            <form action="{{ route('checkout.remove-coupon') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn-close btn-sm" aria-label="Close" title="Gỡ mã"></button>
                            </form>
                        </div>
                    @endif
                </div>

                <!-- Khối tính tiền -->
                <div class="d-flex justify-content-between mb-2 mt-3">
                    <span class="text-muted">Tạm tính:</span>
                    <span>{{ number_format($subtotal, 0, ',', '.') }} đ</span>
                </div>

                @if(session('coupon'))
                <div class="d-flex justify-content-between mb-2 text-success fw-bold">
                    <span>Giảm giá ({{ session('coupon')['percent'] }}%):</span>
                    <span>-{{ number_format($discountAmount, 0, ',', '.') }} đ</span>
                </div>
                @endif

                <div class="d-flex justify-content-between fs-5 mt-2 pt-2 border-top">
                    <span class="fw-bold">Tổng thanh toán:</span>
                    <span class="fw-bold text-danger fs-4">{{ number_format($total, 0, ',', '.') }} đ</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection