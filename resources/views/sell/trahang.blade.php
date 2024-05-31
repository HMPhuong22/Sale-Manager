@extends('layout.sell-master')

@section('sanphamTop')
    {{-- table top --}}
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
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $item->ten_sanpham }}</td>
                    <td>{{ $item->giaxuat }}</td>
                    <td><input type="text" value="{{ $item->soluong }}"></td>
                    <td><input type="text" value=""></td>
                    <td>{{ $item->giaxuat * $item->soluong }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- end table top --}}
@endsection

@section('bantra-hang')
    <div class="container">
        <div class="infomation-customer">
            <table>
                <tr>
                    <td>Tên khách hàng: </td>
                    <td><input type="text"></td>
                </tr>
                <tr>
                    <td>Số điện thoại:</td>
                    <td><input type="text"></td>
                </tr>
            </table>
        </div>

        <div class="infomation-product">
            <table>
                <tr>
                    <td>Tổng số lượng: </td>
                    <td><input type="text" value=""></td>
                </tr>
                <tr>
                    <td>Tổng giá:</td>
                    <td><input type="text" value=""></td>
                </tr>
                <tr>
                    <td>Tổng giá trả hàng:</td>
                    <td><input type="text"></td>
                </tr>
            </table>
        </div>

        <button class="btn-trahang bg-primary mx-auto">Trả hàng</button>
    </div>
@endsection
