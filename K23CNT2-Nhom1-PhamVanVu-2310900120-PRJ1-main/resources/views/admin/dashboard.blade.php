@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2>Bảng điều khiển</h2>
        <p class="text-muted">Tổng quan số liệu hệ thống</p>
    </div>

    <div class="row">
        <!-- Khối Tổng Doanh Thu -->
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-success h-100 shadow-sm">
                <div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
                    <h5 class="card-title mb-3">Tổng Doanh Thu</h5>
                    <h3 class="card-text fw-bold">{{ number_format($totalRevenue, 0, ',', '.') }} đ</h3>
                </div>
            </div>
        </div>

        <!-- Khối Tổng Đơn Hàng -->
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-primary h-100 shadow-sm">
                <div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
                    <h5 class="card-title mb-3">Tổng Đơn Hàng</h5>
                    <h3 class="card-text fw-bold">{{ $totalOrders }}</h3>
                </div>
            </div>
        </div>

        <!-- Khối Tổng Khách Hàng -->
        <div class="col-md-3 mb-4">
            <div class="card bg-warning text-dark h-100 shadow-sm">
                <div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
                    <h5 class="card-title mb-3">Tổng Khách Hàng</h5>
                    <h3 class="card-text fw-bold">{{ $totalCustomers }}</h3>
                </div>
            </div>
        </div>

        <!-- Khối Tổng Số Sách -->
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-danger h-100 shadow-sm">
                <div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
                    <h5 class="card-title mb-3">Tổng Đầu Sách</h5>
                    <h3 class="card-text fw-bold">{{ $totalBooks }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection