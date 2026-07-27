@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Sửa Sách</h2>

    <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label">Tên sách</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $book->title) }}" required>
        </div>

        <div class="mb-3">
         <label class="form-label">Ảnh bìa</label>
         <!-- Hiển thị ảnh cũ nếu có -->
         @if($book->image)
             <div class="mb-2">
                 <img src="{{ asset('storage/' . $book->image) }}" alt="Ảnh bìa" style="max-height: 100px; object-fit: cover;">
             </div>
         @endif
         <!-- Ô chọn ảnh mới -->
         <input type="file" name="image" class="form-control" accept="image/*">
         <small class="text-muted">Bỏ trống nếu bạn không muốn thay đổi ảnh.</small>
     </div>

        <div class="mb-3">
            <label class="form-label">Danh mục</label>
            <select name="category_id" class="form-control" required>
                <option value="">-- Chọn danh mục --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tác giả</label>
            <input type="text" name="author" class="form-control" value="{{ old('author', $book->author) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Giá tiền (VNĐ)</label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $book->price) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả tóm tắt</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $book->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Quay Lại</a>
    </form>
</div>
@endsection