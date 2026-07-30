@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Danh sách Khách hàng</h2>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Form tìm kiếm -->
    <div class="card mb-3">
        <div class="card-body">
            <form action="{{ route('admin.users.index') }}" method="GET" class="row g-3">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Nhập tên hoặc email khách hàng..." value="{{ $search ?? '' }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-secondary">Tìm kiếm</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Xóa lọc</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bảng danh sách -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên khách hàng</th>
                    <th>Email</th>
                    <th>Ngày đăng ký</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td class="text-start">{{ $user->name }}</td>
                    <td class="text-start">{{ $user->email }}</td>
                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info btn-sm text-white">Xem</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Không có dữ liệu khách hàng.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Thanh phân trang -->
    <div class="d-flex justify-content-end mt-3">
        {{ $users->appends(['search' => $search])->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection