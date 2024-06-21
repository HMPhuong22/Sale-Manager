@extends('layout.manage-master')

@section('search-product')
    <div class="search-product p-2">
        <div class="search-aria bg-white">
            <form action="{{ route('admin.quanly.search')}}" method="post">
                @csrf
                <table style="width: 100%">
                    <tr>
                        <td class="col-sm-3 col-4">
                            &nbsp;
                        </td>
                        <td class="col-ms-9 col-8">
                            <div class="input-group my-auto mr-3">
                                <input type="text" class=" mr-2" placeholder="Tìm kiếm sản phẩm theo tên..."
                                    aria-label="Recipient's username" name="search" aria-describedby="basic-addon2">
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
                            @foreach ($listMenu as $item)
                                <a class="dropdown-item category-link" href="javascript:void(0);"
                                    data-id="{{ $item->id_danhmucsanpham }}">{{ $item->ten_danhmucsanpham }}</a>
                            @endforeach
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
                            <a class="dropdown-item" href="{{ route('admin.quanly.color-index') }}">Màu sắc</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.quanly.menu-index') }}">Thêm danh mục hàng hóa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.quanly.addproduct-index') }}">Thêm mặt hàng</a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="right col-sm-10 col-9" id="product-list">
            <table class="table table-striped">
                <thead class="">
                    <tr class="">
                        <th>Ảnh sản phẩm</th>
                        <th>Mã hàng</th>
                        <th>Tên hàng</th>
                        <th>Kích thước</th>
                        <th>Giá bán</th>
                        <th>Tồn kho</th>
                    </tr>
                </thead>
                <tbody id="product-list-body">
                    {{-- Hiển thị danh sách sản phẩm --}}
                    @if (!empty($getProduct))
                        @foreach ($getProduct as $key => $item)
                            <tr>
                                <td class="col-2">
                                    <img style="width: 20%; height: auto;" src="{{ asset('images/' . $item->anh) }}"
                                        alt="ảnh sản phẩm">
                                </td>
                                <td><a href="{{ route('admin.quanly.editproduct-index', ['id' => $item->id_sanpham]) }}"
                                        name="toUpdateProduct" value="">{{ $item->ma_sanpham }}</a></td>
                                <td>{{ $item->ten_sanpham }}</td>
                                <td>{{ $item->ten_kichthuoc }}</td>
                                <td>{{ $item->gia }}</td>
                                <td>{{ $item->soluong }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    {{-- JS  --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.category-link').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    url: '{{ route('admin.quanly.hanghoa-index') }}',
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $('#product-list-body').html($(response).find('#product-list-body')
                            .html());
                    },
                    error: function(xhr) {
                        console.error(xhr);
                    }
                });
            });
        });
    </script>

    </script>
@endsection

@section('footer-content')
    <footer class="fixed-bottom m-2 pr-2">
        <a href="{{ route('admin.quanly.addlistproduct-index') }}" class="btn btn-primary float-right ml-2">+ Nhập hàng</a>
        <a href="{{ route('admin.quanly.addcategory-index') }}" class="btn btn-primary float-right">+ Thêm phân loại hàng
            hóa</a>
    </footer>
@endsection
