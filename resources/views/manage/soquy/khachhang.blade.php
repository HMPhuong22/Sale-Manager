@extends('layout.manage-master')

@section('content')
    <div class="container-soquy">
        <h2>Khách hàng</h2>
        <div class="table-soquy">
            {{-- table content page --}}
            <div id="scroll-soquy" class="table-responsive">  
                <table class="table table-hover">
                    <thead>  
                        <tr>
                            <th>Số thứ tự</th>
                            <th>Mã khách hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Tổng số đơn mua</th>
                            <th>Tổng tiền mua</th>
                        </tr>
                    </thead>    
                    <tbody>
                        @foreach ($getAllCustomer as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->ma_khachhang}}</td>
                                <td>{{$item->ten_khachhang}}</td>
                                <td>{{$item->sodienthoai}}</td>
                                <td>{{$item->countExportInvoice}}</td>
                                <td>{{number_format($item->sumExportInvoice)}} vnd</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
