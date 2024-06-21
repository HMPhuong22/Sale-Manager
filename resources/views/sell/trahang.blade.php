@extends('layout.sell-master')

@section('sanphamTop')
    {{-- table top --}}
    <input type="hidden" class="id-hoa-don-xuat" value="{{ $maHoaDonXuat }}">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Sản phẩm</th>
                <th scope="col">Giá tiền</th>
                <th scope="col">Số lượng mua</th>
                <th scope="col">Số lượng trả</th>
                <th scope="col">Tổng tiền</th>
                <th scope="col">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataInvoice as $key => $item)
                <tr class="danh-sach-tra-item">
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $item->ten_sanpham }}</td>
                    <td><span class="gia">{{ $item->giaxuat }}</span></td>
                    <td><span class="so-luong-mua">{{ $item->soluong }}</span></td>
                    <td><input type="number" class="so-luong-tra" required value="0" min="0"
                            max="{{ $item->soluong }}">
                        <input type="hidden" class="id-sanpham" value="{{ $item->id_sanpham }}">
                    </td>
                    <td>{{ $item->giaxuat * $item->soluong }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- end table top --}}
@endsection

@section('bantra-hang')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="customer-info p-3 bg-light rounded">
                    <h5>Thông tin khách hàng</h5>
                    <table>
                        <tr>
                            <td>Tên khách hàng: </td>
                            <td><input type="text" value="{{ $dataCustomer->ten_khachhang }}">
                                <input type="hidden" value="{{ $dataCustomer->id_khachhang }}" class="id-khach-hang">
                            </td>
                        </tr>
                        <tr>
                            <td>Số điện thoại:</td>
                            <td><input type="text" value="{{ $dataCustomer->sodienthoai }}">
        
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="order-info p-3 bg-light rounded mt-3 infomation-product">
                    <h5>Thông tin đơn hàng</h5>
                    <table>
                        <tr>
                            <td>Tổng số lượng: </td>
                            <td><input type="number" readonly class="tong-so-luong" value=""></td>
                        </tr>
                        <tr>
                            <td>Tổng giá:</td>
                            <td><input type="number" readonly class="tong-gia" value=""></td>
                        </tr>
                    </table>
                </div>
                <button class="btn btn-submit-trahang btn-primary btn-block mt-3">Trả hàng</button>
                <input type="hidden" class="url-backend-trahang" value="{{ route('admin.banhang.trahang-handle') }}">
                <p class="text-center mt-2">Hotline: 036xxxxx50</p>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('/js/trahang.js') }}"></script>
