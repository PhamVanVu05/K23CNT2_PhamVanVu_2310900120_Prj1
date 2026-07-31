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
            <label class="form-label fw-bold">Ảnh bìa</label>
            
            <!-- Hiện ảnh cũ nếu đang ở trang sửa -->
            @if(isset($book) && $book->image)
                <div class="mb-2">
                    <img src="{{ str_contains($book->image, 'http') ? $book->image : asset('storage/' . $book->image) }}" alt="Ảnh bìa" style="max-height: 100px; border-radius: 5px;">
                </div>
            @endif

            <div class="row">
                <!-- Ô 1: Chọn file từ máy -->
                <div class="col-md-6">
                    <label class="text-muted small mb-1">Tải ảnh lên từ máy tính:</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
                
                <!-- Ô 2: Nhập link mạng -->
                <div class="col-md-6">
                    <label class="text-muted small mb-1">Hoặc nhập link ảnh (URL):</label>
                    <input type="url" name="image_url" class="form-control" placeholder="https://ví-dụ.com/anh.jpg" value="{{ old('image_url') }}">
                </div>
            </div>
            <small class="text-muted d-block mt-1">Bỏ trống cả 2 nếu không muốn thay đổi ảnh. Ưu tiên file từ máy nếu bạn nhập cả 2.</small>
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