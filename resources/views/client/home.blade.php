@extends('client.layouts.app')

@section('content')
<div class="row mb-4">
    <div class="d-flex flex-wrap gap-2 mb-4">
        <!-- Nút "Tất cả" -->
        <a href="{{ route('home') }}" 
        class="btn {{ !request('category_id') ? 'btn-primary' : 'btn-outline-primary' }}">
            Tất cả
        </a>

        <!-- Lặp để in ra các danh mục từ Database -->
        @foreach($categories as $category)
            <a href="{{ route('home', ['category_id' => $category->id]) }}" 
            class="btn {{ request('category_id') == $category->id ? 'btn-primary' : 'btn-outline-primary' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>
</div>

<div class="row">
    @forelse($books as $book)
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm book-card">
                <!-- Giả sử cột ảnh của bạn tên là 'image'. Đảm bảo ảnh nằm trong public/uploads/books/ hoặc tùy chỉnh đường dẫn -->
                @if(str_contains($book->image, 'http'))
                    <!-- Dành cho ảnh Seeder tải từ mạng -->
                    <img src="{{ $book->image }}" class="card-img-top" alt="{{ $book->title }}" style="height: 350px; object-fit: cover;">
                @else
                    <!-- Dành cho ảnh tự upload -->
                    <img src="{{ asset('storage/' . $book->image) }}" class="card-img-top" alt="{{ $book->title }}" style="height: 350px; object-fit: cover;">
                @endif
                <div class="card-body d-flex flex-column">
                    <h6 class="card-title fw-bold">{{ $book->title }}</h6>
                    <p class="card-text text-danger fw-bold fs-5 mt-auto">
                        {{ number_format($book->price, 0, ',', '.') }} đ
                    </p>
                    <a href="{{ route('book.detail', $book->id) }}" class="btn btn-primary w-100 mt-2">Xem chi tiết</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center">
            <p class="text-muted">Hiện tại chưa có sách nào trong cửa hàng.</p>
        </div>
    @endforelse
</div>

<!-- Phân trang -->
<div class="d-flex justify-content-center mt-4">
    {{ $books->links('pagination::bootstrap-5') }}
</div>
@endsection