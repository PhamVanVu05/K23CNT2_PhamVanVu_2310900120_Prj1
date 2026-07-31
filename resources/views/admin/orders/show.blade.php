@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2>Chi tiết Đơn hàng #{{ $order->id }}</h2>
    </div>

    <div class="row">
        <!-- ================= CỘT TRÁI (col-md-5) ================= -->
        <div class="col-md-5 mb-4">
            
            <!-- Card 1: Thông tin người nhận -->
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    Thông tin người nhận
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 150px;">Họ và tên:</th>
                            <td>{{ $order->customer_name }}</td>
                        </tr>
                        <tr>
                            <th>Số điện thoại:</th>
                            <td>{{ $order->customer_phone }}</td>
                        </tr>
                        <tr>
                            <th>Địa chỉ:</th>
                            <td>{{ $order->address }}</td>
                        </tr>
                        <tr>
                            <th>Ngày đặt:</th>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Form cập nhật trạng thái -->
            <div class="card">
                <div class="card-header bg-warning text-dark fw-bold">
                    Cập nhật trạng thái
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success py-2">{{ session('success') }}</div>
                    @endif
                    
                    <form action="{{ route('admin.orders.update_status', $order->id) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <select name="status" class="form-select">
                                <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Chờ xử lý</option>
                                <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Đã xác nhận</option>
                                <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Đang giao</option>
                                <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Hoàn thành</option>
                                <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>Đã hủy</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>

        </div> 

        
        <div class="col-md-7 mb-4">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Sản phẩm đã đặt
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên sách</th>
                                    <th>Đơn giá</th>
                                    <th>SL</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orderDetails as $index => $detail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="text-start">{{ $detail->title }}</td>
                                    <td>{{ number_format($detail->price, 0, ',', '.') }} đ</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td class="text-danger fw-bold">
                                        {{ number_format($detail->price * $detail->quantity, 0, ',', '.') }} đ
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" class="text-end fw-bold">TỔNG CỘNG:</td>
                                    <td class="text-danger fw-bold fs-5">{{ number_format($order->total_price, 0, ',', '.') }} đ</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    
    <div class="mb-4">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
    </div>
</div>
@endsection