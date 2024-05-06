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
                            <th>Mã doanh nghiệp</th>
                            <th>Doanh nghiệp</th>
                            <th>Hotline</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                        </tr>
                    </thead>    
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>DN0001</td>
                            <td>Adidas</td>
                            <td>0366589150</td>
                            <td>adidas@gmail.com</td>
                            <td>444 Đội Cấn, Ba Đình, Hà Nội</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
