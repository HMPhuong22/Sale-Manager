@extends('layout.manage-master')

@section('content')
    <div class="container-soquy">
        <h2>Đối tác</h2>
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
                        @foreach ($getDataPartner as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->ma_nhacungcap}}</td>
                                <td>{{$item->ten_nhacungcap}}</td>
                                <td>{{$item->hotline}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->diachi}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
