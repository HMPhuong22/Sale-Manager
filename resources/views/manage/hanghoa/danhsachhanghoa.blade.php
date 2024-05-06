@extends('layout.manage-master')

@section('search-product')
    <div class="search-product p-2">
        <div class="search-aria bg-white">
            <form action="" method="post">
                @csrf
                <table style="width: 100%">
                    <tr>
                        <td class="col-sm-3 col-4">
                            &nbsp;
                        </td>
                        <td class="col-ms-9 col-8">
                            <div class="input-group my-auto mr-3">
                                <input type="text" class=" mr-2" placeholder="Tìm kiếm sản phẩm theo tên..."
                                    aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="submit">Tìm kiếm</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
@endsection

@section('content')
    <div class="row ml-0">

        <div class="left col-sm-2 col-3">
            <h4>Danh mục hàng hóa</h4>
            <nav class="" id="myScrollspy">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Danh mục hàng hóa</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#section41">Quần áo</a>
                            <a class="dropdown-item" href="#section42">Giày</a>
                            <a class="dropdown-item" href="#section42">Phụ kiện khác</a>
                        </div>
                    </li>
                </ul>
            </nav>

            <h4>Chi tiết sản phẩm</h4>
            <nav class="" id="myScrollspy">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Thêm đặc trưng sản
                            phẩm</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('admin.quanly.size-index') }}">Kích thước</a>
                            <a class="dropdown-item" href="">Danh mục sản phẩm</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.quanly.menu-index') }}">Thêm danh mục hàng hóa</a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="right col-sm-10 col-9">
            <table class="table table-striped">
                <thead class="">
                    <tr class="">
                        <th class="col-1">&nbsp;</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Mã hàng</th>
                        <th>Tên hàng</th>
                        <th>Kích thước</th>
                        <th>Giá bán</th>
                        <th>Tồn kho</th>
                    </tr>
                </thead>    
                <tbody>
                    <form action="" method="post">
                        @csrf
                        @if(!empty($getProduct))
                            @foreach ($getProduct as $key => $item)
                                <tr>
                                    <td class="d-flex justify-content-center">
                                        <button class="border-0" type="submit" name="idProduct" value="{{$item->id_sanpham}}">
                                            <i class="fas fa-trash-alt" name="idProduct"></i>
                                        </button>
                                    </td>   
                                    <td class="col-2">
                                        <img style="width: 20%; height: auto;" src="{{asset('images/'.$item->anh)}}" alt="ảnh sản phẩm">
                                    </td>
                                    <td><a href="{{route('admin.quanly.editproduct-index', ["id" => $item->id_sanpham])}}" name="toUpdateProduct" value="">{{$item->ma_sanpham}}</a></td>
                                    <td>{{$item->ten_sanpham}}</td>
                                    <td>{{$item->ten_kichthuoc}}</td>
                                    <td>{{$item->gia}}</td>
                                    <td>{{$item->soluong}}</td>
                                </tr>
                            @endforeach
                        @endif
                    </form>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('footer-content')
    <footer class="fixed-bottom m-2 pr-2">
        <a href="{{ route('admin.quanly.addproduct-index') }}" class="btn btn-primary float-right ml-2">+ Thêm sản phẩm</a>
        <a href="{{ route('admin.quanly.addcategory-index') }}" class="btn btn-primary float-right">+ Thêm phân loại hàng hóa</a>
    </footer>
@endsection
