@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Quản lý Mã giảm giá</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <div class="row">
        <!-- Cột thêm mới mã giảm giá -->
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thêm Mã Mới</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.coupons.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="fw-bold">Mã giảm giá (Code)</label>
                            <input type="text" name="code" class="form-control" placeholder="VD: TRITUE10..." required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="fw-bold">Phần trăm giảm (%)</label>
                            <input type="number" name="discount_percent" class="form-control" min="1" max="100" placeholder="VD: 10, 20..." required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Lưu Mã Code</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Cột hiển thị danh sách -->
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Danh sách Mã giảm giá</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Mã Code</th>
                                    <th>Mức giảm</th>
                                    <th>Ngày tạo</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupon->id }}</td>
                                    <td class="fw-bold text-success">{{ $coupon->code }}</td>
                                    <td class="text-danger fw-bold">-{{ $coupon->discount_percent }}%</td>
                                    <td>{{ \Carbon\Carbon::parse($coupon->created_at)->format('d/m/Y') }}</td>
                                    <td>
                                        <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa mã này?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection