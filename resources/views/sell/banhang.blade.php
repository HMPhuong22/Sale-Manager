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
                    <td class="quantity"><span
                            style="color: {{ $item->soluong <= 0 ? 'red' : 'black' }}">{{ $item->soluong }}</span></td>
                    <td>{{ number_format($item->gia) }} VND</td>
                    {{-- <td><a href="{{route('admin.banhang.add-sell', ['id' => $item->id_sanpham]) }}"><i class="fas fa-plus"></i></a></td> --}}
                    <td class="add">
                        @if ($item->soluong <= 0)
                            <a href="javascript:void(0)" class="disabled" style="pointer-events: none; color: grey;">
                                <i class="fas fa-plus"></i>
                            </a>
                        @else
                            <a onclick="AddSell({{ $item->id_sanpham }})" href="javascript:;">
                                <i class="fas fa-plus"></i>
                            </a>
                        @endif
                    </td>

                    {{-- <td><input class="checkPro" name="checkPro[]" type="checkbox" value="{{ $item->id_sanpham }}"></td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- end table top --}}

    {{-- javasript --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function AddSell(id) {
            // console.log(id);
            $.ajax({
                url: "{{ route('admin.banhang.add-sell', ':id') }}".replace(':id', id),
                type: 'GET',
            }).done(function(result) {
                if (result != null) {
                    // console.log(result);
                    RenderLayourSell(result);
                } else {
                    console.log('Không có kết quả trả về');
                }
            });
        }

        // Xử lý sự kiện click nút xóa items sell
        function handleClick(event) {
            // event.preventDefault();
            $('#change-item').on("click", "td a", function() {
                // console.log($(this).data('id'));
                $.ajax({
                    url: "{{ route('admin.banhang.delete-item-sell', ':id') }}".replace(':id', $(this)
                        .data('id')),
                    type: 'GET',
                }).done(function(result) {
                    // console.log($(this).data('id'));
                    if (result != null) {
                        RenderLayourSell(result);
                    } else {
                        console.log('Không có kết quả trả về');
                    }
                });
            })
        }

        // Render giao diện
        function RenderLayourSell(result) {
            $('#change-item').empty();
            $('#change-item').html(result);
            $('#total-quantity-show').text($("#total-quantity").val());
            $('#total-price-show').text($("#total-price").val());
        }
    </script>
@endsection

@section('title')
    <div class="container mt-2 mb-2">
        <div class="row justify-content-end">
            <div class="col">
                <h3 class="font-weight-bold">Đơn hàng</h3>
            </div>
            <div class="col-auto row mr-5">
            </div>
        </div>
    </div>
@endsection

@section('checkControl')
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
    <table class="table table-hover">
        <tbody id="change-item">
            {{-- Hiển thị danh sách sản phẩm trong đơn hàng --}}
            @if (Session::has('Sell') != null)
                @foreach (Session::get('Sell')->products as $key => $item)
                    <tr>
                        <input type="hidden" name="id-product" value="{{ $item['productInf']->id_sanpham }}">
                        <td name="id-product">{{ $item['productInf']->ten_sanpham }} -
                            {{ $item['productInf']->ten_kichthuoc }}</td>
                        {{-- <td>{{$item['productInf']->id_kichthuoc}}</td> --}}
                        <td name="price-product">{{ number_format($item['productInf']->gia) }}</td>
                        <td class="product-details">
                            <input id="quantity" name="quantity-porduct" type="number" min="1"
                                max="{{ $item['productInf']->soluong }}" style="width: 40%" value="{{ $item['quanty'] }}"
                                required>
                        </td>
                        <td><span name="total-product">{{ number_format($item['gia']) }}</span></td>
                        <td class="si-close">
                            <a onclick="handleClick(event)" data-id="{{ $item['productInf']->id_sanpham }}"
                                href="javascript:">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{-- end table bottom --}}
@endsection

@section('bantra-hang')
    {{-- lấy dữ liệu thanh toán --}}
    <form action="{{ route('admin.banhang.save-pay') }}" method="post">
        @csrf
        <div class="col-md-12 mt-5 font-weight-bold">
            <div class="form-group">
                <label for="customerName">Tên khách hàng:</label>
                <input type="text" class="form-control" id="customerName" name="name-customer" required>
            </div>
            <div class="form-group">
                <label for="customerPhone">Số điện thoại:</label>
                <input type="text" class="form-control" id="customerPhone" name="phonenumber-customer" required>
            </div>

            @if (Session::has('Sell') != null)
                <div class="form-group">
                    <label for="totalQuantity" class="font-weight-bold">Tổng số lượng:</label>
                    {{-- <input type="number" class="form-control" id="total-quantity-show" value="{{ Session::get('Sell')->totalQuatity }}" readonly> --}}
                    <span id="total-quantity-show">{{ Session::get('Sell')->totalQuatity }}</span>
                </div>
                <div class="form-group">
                    <label for="totalPrice" class="font-weight-bold">Tổng giá:</label>
                    {{-- <input type="text" class="form-control" id="total-price-show" value="{{ Session::get('Sell')->totalPrice }}" readonly> --}}
                    <span id="total-price-show">{{ Session::get('Sell')->totalPrice }}</span>
                </div>
            @else
                <div class="form-group">
                    <label for="totalQuantity" class="font-weight-bold">Tổng số lượng:</label>
                    <span id="total-quantity-show">0</span>
                </div>
                <div class="form-group">
                    <label for="totalPrice" class="font-weight-bold">Tổng giá:</label>
                    <span id="total-price-show">0</span>
                </div>
            @endif

            <div class="form-group font-weight-bold">
                <label for="totalDiscount">Tổng giá giảm:</label>
                <input type="text" name="discount" class="form-control" id="totalDiscount" value="0">
            </div>

            <div class="form-group">
                <label for="cod" class="font-weight-bold">COD:</label>
                @if (Session::has('Sell') != null)
                    <span id="total-price-show">{{ number_format(Session::get('Sell')->totalPrice) }} vnđ</span>
                @else
                    <span id="total-price-show">0</span>
                @endif
            </div>
            <button type="submit" id="salesButton" class="btn btn-success btn-block">Bán hàng</button>
        </div>

        {{-- <div class="infomation-customer">
            <table class="table table-bordered" id="selectedProducts">
                <tr>
                    <td>Tên khách hàng: </td>
                    <td><input type="text" name="name-customer" required></td>
                </tr>
                <tr>
                    <td>Số điện thoại:</td>
                    <td><input type="text" name="phonenumber-customer" required></td>
                </tr>
            </table>
        </div> --}}

        {{-- <div class="infomation-product">
            <table class="table table-bordered"> --}}
        {{-- thanh toán đơn hàng --}}
        {{-- @if (Session::has('Sell') != null) --}}
        {{-- <tr>
                        <td>Tổng số lượng: </td>
                        <td><span id="total-quantity-show">{{ Session::get('Sell')->totalQuatity }}</span></td>
                    </tr>
                    <tr>
                        <td>Tổng giá:</td>
                        <td><span id="total-price-show">{{ Session::get('Sell')->totalPrice }}</span></td>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td>Tổng số lượng: </td>
                        <td><span id="total-quantity-show">0</span></td>
                    </tr>
                    <tr>
                        <td>Tổng giá: </td>
                        <td><span id="total-price-show">0</span></td>
                    </tr>
                @endif
                <tr>
                    <td>Tổng giá giảm: </td>
                    <td><input name="discount" type="text" value="0"></td>
                </tr>
            </table>
        </div> --}}

        {{-- <div class="container">
            <div class="">
                <tbale>
                    <tr>
                        <td>
                            <label for="">COD: </label>
                        </td>
                        <td>
                            @if (Session::has('Sell') != null)
                                <span>{{ Session::get('Sell')->totalPrice }}</span>
                            @else
                                <span id="total-price-show">0</span>
                            @endif
                        </td>
                        <td>
                            <button type="submit" class="btn btn-success mt-3">Bán hàng</button>
                        </td>
                    </tr>
                </tbale>
            </div>
        </div> --}}
    </form>
@endsection
