@extends('client.layouts.app')

@section('content')
<div class="row mt-4 mb-5">
    <div class="col-12">
        <h3 class="fw-bold mb-4">Giỏ hàng của bạn</h3>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(count($cart) > 0)
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th style="width: 120px;">Số lượng</th>
                        <th>Tổng tiền</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cart as $id => $item)
                        @php 
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $item['image']) }}" width="50" class="me-2" alt="book">
                                <strong>{{ $item['title'] }}</strong>
                            </td>
                            <td class="text-danger fw-bold">{{ number_format($item['price'], 0, ',', '.') }} đ</td>
                            <td>
                                <input type="number" class="form-control text-center" value="{{ $item['quantity'] }}" readonly>
                            </td>
                            <td class="text-danger fw-bold">{{ number_format($subtotal, 0, ',', '.') }} đ</td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa cuốn sách này khỏi giỏ hàng?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="d-flex justify-content-end align-items-center mt-4">
                <h4 class="me-4">Tổng cộng: <span class="text-danger fw-bold">{{ number_format($total, 0, ',', '.') }} đ</span></h4>
                <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg">Tiến hành Thanh toán</a>
            </div>
        @else
            <div class="alert alert-warning text-center p-5">
                <p class="fs-5 mb-3">Giỏ hàng của bạn đang trống.</p>
                <a href="{{ route('home') }}" class="btn btn-primary">Quay lại mua sắm</a>
            </div>
        @endif
    </div>
</div>
@endsection