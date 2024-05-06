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
                            <th>Ngày đặt hàng</th>
                            <th>Đơn đặt</th>
                        </tr>
                    </thead>    
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>KH0001</td>
                            <td>Hà Minh Phương</td>
                            <td>0366589150</td>
                            <td><a href="#">SP0002</a></td>
                            <td>12/3/2024</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
