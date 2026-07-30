@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Chi Tiết Sách</h2>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" alt="Ảnh bìa" class="img-fluid rounded shadow-sm" style="max-height: 400px;">
                    @else
                        <div class="p-5 bg-light text-muted border">Không có ảnh</div>
                    @endif
                </div>
                
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th style="width: 200px;">Tên sách</th>
                                <td><strong>{{ $book->title }}</strong></td>
                            </tr>
                            <tr>
                                <th>Danh mục</th>
                                <td>{{ $book->category_name }}</td>
                            </tr>
                            <tr>
                                <th>Tác giả</th>
                                <td>{{ $book->author }}</td>
                            </tr>
                            <tr>
                                <th>Giá tiền</th>
                                <td>{{ number_format($book->price, 0, ',', '.') }} VNĐ</td>
                            </tr>
                            <tr>
                                <th>Trạng thái</th>
                                <td>
                                    @if(isset($book->is_active) && $book->is_active == 1)
                                        <span class="badge bg-success">Đang hiện</span>
                                    @else
                                        <span class="badge bg-secondary">Đang ẩn</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Mô tả tóm tắt</th>
                                <td>{{ $book->description ?? 'Không có mô tả' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
            <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-warning">Sửa cuốn sách này</a>
        </div>
    </div>
</div>
@endsection