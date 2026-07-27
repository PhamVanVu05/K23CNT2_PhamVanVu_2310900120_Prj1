@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Thêm Sách Mới</h2>

    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label class="form-label">Tên sách</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
         <label class="form-label">Ảnh bìa</label>
         <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label">Danh mục</label>
            <select name="category_id" class="form-control" required>
                <option value="">-- Chọn danh mục --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tác giả</label>
            <input type="text" name="author" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Giá tiền (VNĐ)</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả tóm tắt</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Lưu Sách</button>
        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Quay Lại</a>
    </form>
</div>
@endsection