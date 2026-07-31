@extends('client.layouts.app')

@section('content')
<div class="row mt-4 mb-5">
    <div class="col-md-4">
        <!-- Đường dẫn ảnh lấy chuẩn theo cách 1 mà bạn đã test thành công -->
        @if(str_contains($book->image, 'http'))
            <!-- Dành cho ảnh Seeder tải từ mạng -->
            <img src="{{ $book->image }}" class="img-fluid rounded shadow-sm w-100" alt="{{ $book->title }}">
        @else
            <!-- Dành cho ảnh tự upload -->
            <img src="{{ asset('storage/' . $book->image) }}" class="img-fluid rounded shadow-sm w-100" alt="{{ $book->title }}">
        @endif
    </div>
    
    <div class="col-md-8 pl-md-4">
        <h2 class="fw-bold">{{ $book->title }}</h2>
        <h3 class="text-danger fw-bold mt-3">{{ number_format($book->price, 0, ',', '.') }} đ</h3>
        
        <hr>
        
        <div class="mb-4">
            <!-- Tùy vào tên cột trong database mà bạn chỉnh lại biến $book->... cho chuẩn nhé -->
            <p class="mb-1"><span class="fw-bold">Tác giả:</span> {{ $book->author ?? 'Đang cập nhật' }}</p>
            <p class="mb-1"><span class="fw-bold">Số lượng kho:</span> {{ $book->quantity ?? 0 }} cuốn</p>
        </div>
        
        <h5 class="fw-bold mt-4">Mô tả nội dung:</h5>
        <div class="text-muted" style="line-height: 1.8;">
            {{ $book->description ?? 'Chưa có mô tả chi tiết cho cuốn sách này.' }}
        </div>
        
        <div class="mt-5 p-4 bg-white border rounded shadow-sm">
            <form action="{{ route('cart.add', $book->id) }}" method="POST" class="d-flex align-items-center">
                @csrf
                <label for="quantity" class="fw-bold me-3">Số lượng:</label>
                <input type="number" id="quantity" name="quantity" value="1" min="1" class="form-control text-center me-3" style="width: 90px;">
                <button type="submit" class="btn btn-danger btn-lg px-5">
                    Thêm vào giỏ hàng
                </button>
            </form>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <h4 class="fw-bold border-bottom pb-2">Đánh giá & Bình luận</h4>

                <!-- Hiển thị thông báo -->
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <!-- Form nhập đánh giá -->
                <div class="card shadow-sm mb-4 border-0 bg-light">
                    <div class="card-body">
                        @if(Auth::check())
                            <!-- Form trỏ về route book.review kèm theo ID của sách -->
                            <form action="{{ route('book.review', $book->id) }}" method="POST">
                                @csrf
                                <div class="mb-3 d-flex align-items-center">
                                    <label class="fw-bold me-3">Chấm điểm:</label>
                                    <select name="rating" class="form-select w-auto" required>
                                        <option value="5">⭐⭐⭐⭐⭐ (5 Sao - Tuyệt đỉnh)</option>
                                        <option value="4">⭐⭐⭐⭐ (4 Sao - Rất hay)</option>
                                        <option value="3">⭐⭐⭐ (3 Sao - Bình thường)</option>
                                        <option value="2">⭐⭐ (2 Sao - Hơi chán)</option>
                                        <option value="1">⭐ (1 Sao - Tệ)</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <textarea name="comment" class="form-control" rows="3" placeholder="Chia sẻ cảm nhận của bạn về cuốn sách này..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                            </form>
                        @else
                            <p class="mb-0 text-muted">Vui lòng <a href="{{ route('client.login') }}" class="text-primary fw-bold">đăng nhập</a> để tham gia bình luận.</p>
                        @endif
                    </div>
                </div>

                <!-- Danh sách các bình luận -->
                <div class="review-list">
                    @forelse($reviews as $review)
                        <div class="d-flex mb-4 border-bottom pb-3">
                            <div class="me-3">
                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 45px; height: 45px; font-size: 18px;">
                                    {{ strtoupper(substr($review->user_name, 0, 1)) }}
                                </div>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">{{ $review->user_name }}</h6>
                                <div class="text-warning mb-2" style="font-size: 14px;">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            ★
                                        @else
                                            ☆
                                        @endif
                                    @endfor
                                </div>
                                <p class="mb-1">{{ $review->comment }}</p>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($review->created_at)->format('d/m/Y H:i') }}</small>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted fst-italic">Chưa có đánh giá nào cho cuốn sách này. Hãy là người đầu tiên nhận xét!</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection