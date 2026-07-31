@extends('admin.layouts.app')

@section('title', 'Thêm mới Danh mục')

@section('content')
    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
        <h1 class="h3">Thêm mới Danh mục</h1>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf <!-- Token bảo mật bắt buộc của Laravel -->
                
                <div class="mb-3">
                    <label class="form-label">Tên danh mục <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Nhập tên danh mục..." required>
                    @error('name')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Nhập mô tả chi tiết..."></textarea>
                </div>

                <button type="submit" class="btn btn-success">Lưu danh mục</button>
            </form>
        </div>
    </div>
@endsection