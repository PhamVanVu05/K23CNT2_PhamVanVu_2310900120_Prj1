@extends('client.layouts.app')

@section('content')
<div class="container mt-4 mb-5">
    <h3 class="fw-bold mb-4">Lịch sử đơn hàng của bạn</h3>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            @if($orders->isEmpty())
                <div class="text-center py-4">
                    <p class="text-muted fs-5">Bạn chưa có đơn hàng nào.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">Mua sắm ngay</a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Mã ĐH</th>
                                <th>Ngày đặt</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td class="fw-bold">#{{ $order->id }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</td>
                                <td class="text-danger fw-bold">{{ number_format($order->total_price, 0, ',', '.') }} đ</td>
                                <td>
                                    @if($order->status == 0)
                                        <span class="badge bg-warning text-dark">Chờ xử lý</span>
                                    @elseif($order->status == 1)
                                        <span class="badge bg-info text-dark">Đang giao hàng</span>
                                    @elseif($order->status == 2)
                                        <span class="badge bg-success">Hoàn thành</span>
                                    @else
                                        <span class="badge bg-danger">Đã hủy</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection