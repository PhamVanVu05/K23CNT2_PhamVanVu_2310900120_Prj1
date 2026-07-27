@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Danh sách Đơn hàng</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form tìm kiếm và lọc -->
    <div class="card mb-3">
        <div class="card-body">
            <form action="{{ route('admin.orders.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Tên hoặc SĐT khách hàng..." value="{{ $search ?? '' }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">-- Tất cả trạng thái --</option>
                        <option value="0" {{ isset($status) && $status == '0' ? 'selected' : '' }}>Chờ xử lý</option>
                        <option value="1" {{ isset($status) && $status == '1' ? 'selected' : '' }}>Đã xác nhận</option>
                        <option value="2" {{ isset($status) && $status == '2' ? 'selected' : '' }}>Đang giao</option>
                        <option value="3" {{ isset($status) && $status == '3' ? 'selected' : '' }}>Hoàn thành</option>
                        <option value="4" {{ isset($status) && $status == '4' ? 'selected' : '' }}>Đã hủy</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-secondary">Lọc dữ liệu</button>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">Xóa lọc</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bảng danh sách -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Mã ĐH</th>
                    <th>Khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Tổng tiền</th>
                    <th>Ngày đặt</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td class="text-start">{{ $order->customer_name }}</td>
                    <td>{{ $order->customer_phone }}</td>
                    <td class="text-danger fw-bold">{{ number_format($order->total_price, 0, ',', '.') }} đ</td>
                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</td>
                    <td>
                        @if($order->status == 0)
                            <span class="badge bg-warning text-dark">Chờ xử lý</span>
                        @elseif($order->status == 1)
                            <span class="badge bg-info text-dark">Đã xác nhận</span>
                        @elseif($order->status == 2)
                            <span class="badge bg-primary">Đang giao</span>
                        @elseif($order->status == 3)
                            <span class="badge bg-success">Hoàn thành</span>
                        @else
                            <span class="badge bg-danger">Đã hủy</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm text-white">Xem chi tiết</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Chưa có đơn hàng nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Phân trang -->
    <div class="d-flex justify-content-end mt-3">
        {{ $orders->appends(['search' => $search, 'status' => $status])->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection