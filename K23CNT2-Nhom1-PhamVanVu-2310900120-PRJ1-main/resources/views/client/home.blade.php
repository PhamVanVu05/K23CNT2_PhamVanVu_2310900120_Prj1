@extends('client.layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold border-bottom pb-2">Sách Mới Nổi Bật</h2>
    </div>
</div>

<div class="row">
    @forelse($books as $book)
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm book-card">
                <!-- Giả sử cột ảnh của bạn tên là 'image'. Đảm bảo ảnh nằm trong public/uploads/books/ hoặc tùy chỉnh đường dẫn -->
                <img src="{{ asset($book->image) }}" class="card-img-top" alt="{{ $book->title }}">
                <div class="card-body d-flex flex-column">
                    <h6 class="card-title fw-bold">{{ $book->title }}</h6>
                    <p class="card-text text-danger fw-bold fs-5 mt-auto">
                        {{ number_format($book->price, 0, ',', '.') }} đ
                    </p>
                    <a href="#" class="btn btn-primary w-100 mt-2">Xem chi tiết</a>
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