@extends('layout.sell-master')

@section('search')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <form action="{{ route('admin.banhang.checks') }}" method="post">
        @csrf
        <div class="navbar-left m-3">
            <input name="keySearch" type="text" id="searchProduct" placeholder="Search...">
            {{-- <button type="submit">Search</button> --}}
            {{-- <ul id="searchResults">
                <li id="noResultsItem" style="display: none;">
                    Không có sản phẩm tồn tại</li>
            </ul> --}}
        </div>
    </form>
@endsection

@section('sanphamTop')
    {{-- Hiển thị danh sách sản phẩm lấy từ cơ sở dữ liệu --}}
    {{-- table top --}}
    {{-- <form id="productForm" action="" method="post"> --}}
    <table class="table table-striped" id="show-Products">
        <tbody>
            @foreach ($customerSearch as $key => $item)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td class="col-2">
                        <img style="width: 20%; height: auto;" src="{{ asset('images/' . $item->anh) }}" alt="ảnh sản phẩm">
                    </td>
                    <td>{{ $item->ten_sanpham }}</td>
                    <td>{{ $item->ten_kichthuoc }}</td>
                    <td>{{ $item->soluong }}</td>
                    <td>{{ number_format($item->gia) }} VND</td>
                    {{-- <td><a href="{{route('admin.banhang.add-sell', ['id' => $item->id_sanpham]) }}"><i class="fas fa-plus"></i></a></td> --}}
                    <td><a onclick="AddSell({{ $item->id_sanpham }})" href="javascript:"><i class="fas fa-plus"></i></a>
                    </td>

                    {{-- <td><input class="checkPro" name="checkPro[]" type="checkbox" value="{{ $item->id_sanpham }}"></td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- </form> --}}
    {{-- end table top --}}

    {{-- javasript --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function AddSell(id) {  
            // console.log(id);
            $.ajax({
                url: "{{ route('admin.banhang.add-sell', ':id')}}".replace(':id', id),
                type: 'GET', 
            }).done(function(result){
                if(result != null){
                    // console.log(result);
                    $('#change-item').empty();
                    $('#change-item').html( result );
                }else{
                    console.log('Không có kết quả trả về'); 
                }
            });
        }

        // Xử lý sự kiện click nút xóa items sell
        function handleClick(event) {
            // event.preventDefault();
            $('#change-item').on('click', '.si-close a', function(){
                // console.log($(this).data('id'));
                $.ajax({
                    url: "{{ route('admin.banhang.delete-item-sell', ':id')}}".replace(':id', $(this).data('id')),
                    type: 'GET', 
                }).done(function(result){
                    // console.log($(this).data('id'));
                    if(result != null){
                        $('#change-item').empty();
                        $('#change-item').html( result );
                    }else{
                        console.log('Không có kết quả trả về');
                    }
                });
            })
        }
    </script>
@endsection

@section('title')
    <div class="container mt-2 mb-2">
        <div class="row justify-content-end">
            <div class="col">
                <h3>Đơn hàng</h3>
            </div>
            <div class="col-auto row mr-5">
            </div>
        </div>
    </div>
@endsection

@section('checkControl')
    {{-- <script>
        $(document).ready(function() {
            // lấy giá trị của input và gán giá trị cho keyword mỗi lần input thay đổi
            $('#searchProduct').on('input', function() {
                var keyword = $(this).val();

                $.ajax({
                    url: "{{ route('admin.banhang.checks') }}",
                    type: 'GET',
                    data: {
                        keyword: keyword
                    },
                    success: function(response) {
                        response =
                            var searchResults = $('#searchResults');
                        var noResultsItem = $('#noResultsItem');

                        searchResults.empty();
                        if (res.length > 0) {
                            $.each(res, function(index, product) {
                                var listProducShow = $('<li>' + product.ten_sanpham +
                                    '</li>');
                                // listItem.on('click', function() {
                                //     addToCart(product);
                                // });
                                searchResults.append(listProducShow);
                            });
                        } else {
                            noResultsItem.show();
                        }
                    }
                });
            });
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productForm = document.getElementById('productForm');
            const selectedProductsTable = document.getElementById('selectedProducts');

            productForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Ngăn chặn việc gửi biểu mẫu

                // Xóa các sản phẩm đã chọn trước đó
                selectedProductsTable.innerHTML = '';

                // Lấy tất cả các checkbox được chọn
                const checkboxes = document.querySelectorAll('.checkPro:checked');

                // Lặp qua các checkbox được chọn và thêm các sản phẩm đã chọn vào phần dưới
                checkboxes.forEach(function(checkbox) {
                    const productId = checkbox.value;
                    const productName = checkbox.parentNode.parentNode.querySelector(
                        'td:nth-child(3)').innerText; // Lấy tên sản phẩm từ hàng tương ứng
                    const productSize = checkbox.parentNode.parentNode.querySelector(
                        'td:nth-child(4)').innerText; // Lấy size sản phẩm từ input hidden Size

                    // Lấy giá trị của cout từ trường nhập
                    let coutMax = parseInt(checkbox.parentNode.parentNode.querySelector(
                        'td:nth-child(5)').innerText); // lấy tổng số lượng trong csdl
                    let coutDefault = 0; // tạo số lượng mặc định của sản phẩm
                    let cout = 0;

                    // Tạo hàng mới cho sản phẩm đã chọn trong phần dưới
                    const newRow = document.createElement('tr');
                    newRow.innerHTML = `  
                    <th scope="row">${selectedProductsTable.rows.length + 1}</th>
                    <td>${productName}</td> 
                    <td>${productSize}</td> 
                    <td><input name="quantity" type="number" style="width: 50px;" value="${coutDefault}" ${cout > coutMax ? 'disabled' : ''}></td>
                    `;

                    let coutInput = newRow.querySelector('input[name="quantity"]').value;
                    cout = parseInt(coutInput);
                    console.log(cout);

                    // Thêm hàng mới vào bảng phần dưới
                    selectedProductsTable.appendChild(newRow);
                });
            });
        });
    </script>
@endsection

@section('sanphamBottom')
    {{-- table bottom --}}
    <table class="table table-striped">
        <tbody id="change-item">
            {{-- Hiển thị danh sách sản phẩm trong đơn hàng --}}
        </tbody>
    </table>
    {{-- end table bottom --}}
@endsection

@section('bantra-hang')
    <div class="container">
        <div class="infomation-customer">
            <table id="selectedProducts">
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
                    <td><input type="text"></td>
                </tr>
                <tr>
                    <td>Tổng giá:</td>
                    <td><input type="text"></td>
                </tr>
                <tr>
                    <td>Tổng giá giảm:</td>
                    <td><input type="text"></td>
                </tr>
            </table>
        </div>

        <div class="success">
            <p>
                <label for="" style="font-size: 30px;">COD: </label>
                <input type="text" name="" id="">
                <button class="bg-success">Bán hàng</button>
            </p>
        </div>
    </div>
@endsection
