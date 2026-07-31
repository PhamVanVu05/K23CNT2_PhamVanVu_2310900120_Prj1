@extends('admin.layouts.app')

@section('title', 'Quản lý Danh mục')

@section('content')
    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
        <h1 class="h3">Danh sách Danh mục Sách</h1>
        <!-- Đổi từ href="#" thành như sau -->
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Thêm mới danh mục</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th width="50">ID</th>
                        <th>Tên danh mục</th>
                        <th>Mô tả</th>
                        <th width="180" class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td><strong>{{ $category->name }}</strong></td>
                            <td>{{ $category->description ?? 'Chưa có mô tả' }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Chưa có danh mục nào trong hệ thống.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection