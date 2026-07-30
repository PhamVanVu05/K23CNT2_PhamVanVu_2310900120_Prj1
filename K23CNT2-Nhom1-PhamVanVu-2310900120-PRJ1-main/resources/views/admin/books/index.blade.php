@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Danh sách Sách</h2>
        <a href="{{ route('admin.books.create') }}" class="btn btn-primary">+ Thêm mới sách</a>
    </div>

    <!-- Form tìm kiếm -->
    <div class="card mb-3">
        <div class="card-body">
            <form action="{{ route('admin.books.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Nhập tên sách cần tìm..." value="{{ $search ?? '' }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary">Tìm kiếm</button>
                    <a href="{{ route('admin.books.index') }}" class="btn btn-outline-secondary">Xóa lọc</a>
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên sách</th>
                    <th>Ảnh</th>
                    <th>Danh mục</th>
                    <th>Tác giả</th>
                    <th>Giá</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>
                        @if($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" alt="Ảnh" style="max-height: 50px; object-fit: cover;">
                        @else
                            <span class="text-muted">Không có ảnh</span>
                        @endif
                    </td>
                    <td>{{ $book->category_name }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ number_format($book->price, 0, ',', '.') }} đ</td>
                    <td>
                        <!-- Form thay đổi trạng thái -->
                        <form action="{{ route('admin.books.toggle-status', $book->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            @if(isset($book->is_active) && $book->is_active == 1)
                                <button type="submit" class="btn btn-sm btn-success">Đang hiện</button>
                            @else
                                <button type="submit" class="btn btn-sm btn-secondary">Đang ẩn</button>
                            @endif
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('admin.books.show', $book->id) }}" class="btn btn-info btn-sm text-white">Xem</a>
                        <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa cuốn sách này không?');">
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
    <!-- Thanh phân trang -->
    <div class="d-flex justify-content-end mt-3">
        {{ $books->appends(['search' => $search])->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection