@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Quản lý Đánh giá & Bình luận</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách Đánh giá</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Khách hàng</th>
                            <th>Tên sách</th>
                            <th>Đánh giá</th>
                            <th>Nội dung bình luận</th>
                            <th>Thời gian</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                        <tr>
                            <td>{{ $review->id }}</td>
                            <td class="fw-bold">{{ $review->user_name }}</td>
                            <td class="text-primary">{{ $review->book_title }}</td>
                            <td>
                                <span class="text-warning fw-bold">{{ $review->rating }} Sao</span>
                            </td>
                            <td>{{ $review->comment }}</td>
                            <td>{{ \Carbon\Carbon::parse($review->created_at)->format('d/m/Y H:i') }}</td>
                            <td>
                                <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đánh giá này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection