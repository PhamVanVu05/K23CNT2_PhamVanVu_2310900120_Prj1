@extends('admin.layouts.app') <!-- Tùy chỉnh lại theo layout của bạn -->

@section('content')
<div class="container mt-4">
    <h2>Sửa Danh Mục</h2>
    
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Bắt buộc phải có để báo cho Laravel đây là lệnh Update -->

        <div class="mb-3">
            <label for="name" class="form-label">Tên danh mục</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Đường dẫn tĩnh (Slug)</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $category->slug) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $category->description) }}</textarea>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ $category->is_active ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Trạng thái (Hiển thị)</label>
        </div>

        <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay Lại</a>
    </form>
</div>
@endsection