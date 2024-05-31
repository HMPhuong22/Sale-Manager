@extends('layout.manage-master')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <form method="POST" action="">
        {{-- @csrf --}}
        <input type="hidden" name="token" value="">
        <div class="form-group">
            <div class="m-3">
                {{-- <input type="text"
                    style="border-radius: 20px; width: 400px; /* Chiều rộng */
                height: 40px; /* Chiều cao */
                padding: 10px; /* Khoảng cách bên trong */
                border: 1px solid #ccc; /* Đường viền bao quanh */"
                    name="search-pro" placeholder="Tìm kiếm sản phẩm"> --}}
                <button type="button" class="btn btn-secondary" onclick="addProductRow()">Thêm sản phẩm</button>
                <button id="saveProducts" type="submit" class="btn btn-primary">Lưu sản phẩm</button>
            </div>

            {{-- partial view --}}
            <div class="dynamic-product-rows row">
                {{-- hiển thị danh sách sản phẩm khi người dùng bấm nút thêm sản phẩm --}}
            </div>
        </div>
        {{-- end partial view --}}
    </form>

    <script>
        // Initialize an empty array to store product data
        // let productsData = [];

        // Hàm thêm hàng sản phẩm mới
        function addProductRow() {
            const productRowTemplate = `
            <div class="product-row bg-white col-md-12 p-3 mt-2 mb-2 rounded">
                <div class="form-row  ">
                    <div class="col-md-4">
                        <input type="text" id="namePro" class="form-control" name="products[][name]" placeholder="Tên sản phẩm" required>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="products[][code]" placeholder="Mã sản phẩm" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" step="0.01" class="form-control" name="products[][price]" placeholder="Giá" required>
                    </div>
                    <div class="col-md-1">
                        <input type="number" step="0.01" class="form-control" name="products[][quantity]" placeholder="Số lượng" required>
                    </div>
                    <div class="col-md-3">
                        <input type="file" class="h-full w-full opacity-0" accept="image/*" name="products[][image]">
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" required>
                            @foreach ($listSize as $item)
                                <option name="products[][size]" value="{{ $item->id_kichthuoc }}">{{ $item->ten_kichthuoc }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control"  required>
                            @foreach ($listCate as $item)
                                <option name="products[][category]" value="{{ $item->id_loaihang }}">{{ $item->ten_loaihang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control"  required>
                            @foreach ($listLocals as $item)
                                <option name="products[][local]" value="{{ $item->id_nhacungcap }}">{{ $item->ten_nhacungcap }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control"  required>
                            @foreach ($listMenu as $item)
                                <option name="products[][menu]" value="{{ $item->id_danhmucsanpham }}">{{ $item->ten_danhmucsanpham }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <textarea class="form-control" name="products[][description]" rows="3" placeholder="Mô tả"></textarea>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger mt-2" onclick="deleteProductRow(this)">Xóa</button>
                    </div>
                </div>
            </div>
        `;
            const productRows = document.querySelector('.dynamic-product-rows');
            const newProductRow = document.createElement('div');
            newProductRow.innerHTML = productRowTemplate;
            productRows.appendChild(newProductRow);
        }

        // Hàm xóa item sản phẩm
        function deleteProductRow(button) {
            const productRow = button.parentNode.parentNode.parentNode.parentNode;
            productRow.parentNode.removeChild(productRow);
        }

        // Hàm xử lý submit form với AJAX
        const submitBtn = document.getElementById('saveProducts');
        saveProducts.addEventListener('click', function(e) {
            e.preventDefault(); // Ngăn chặn submit form mặc định

            const productRows = document.querySelectorAll('.product-row');
            const productList = [];

            for (const productRow of productRows) {
                const productName = productRow.querySelector('input[name="products[][name]"]').value;
                const productCode = productRow.querySelector('input[name="products[][code]"]').value;
                const productPrice = productRow.querySelector('input[name="products[][price]"]').value;
                const productQuantity = productRow.querySelector('input[name="products[][quantity]"]').value;
                const productImage = productRow.querySelector('input[name="products[][image]"]').value;
                const productSize = productRow.querySelector('option[name="products[][size]"]').value;
                const productCategory = productRow.querySelector('option[name="products[][category]"]').value;
                const productLocal = productRow.querySelector('option[name="products[][local]"]').value;
                const productMenu = productRow.querySelector('option[name="products[][menu]"]').value;
                const productDescription = productRow.querySelector('textarea[name="products[][description]"]')
                    .value;

                productList.push({
                    name: productName,
                    code: productCode,
                    price: productPrice,
                    quantity: productQuantity,
                    image: productImage,
                    size: productSize,
                    category: productCategory,
                    local: productLocal,
                    menu: productMenu,
                    description: productDescription,
                });
            }
            // Hiển thị filteredProductList trên console để xác minh (tùy chọn)
            console.log("Danh sách sản phẩm đã lọc:");
            for (const product of productList) {
                console.log(product);
            }
            const csrfToken = document.querySelector('meta[name="csrf-token"]')
                .content; // Lấy CSRF token từ meta element
            console.log(csrfToken);

            // chuyển đổi dữ liệu mảng sang dạng JSON
            // const productListJson = JSON.stringify(productList);
            // console.log(productListJson);

            // Loại bỏ các item sản phẩm đã xóa khỏi productList
            // const filteredProductList = productList.filter(product => product.parentNode != null);
            
            // Gửi yêu cầu AJAX đến controller với dữ liệu productList đã lọc
            fetch('{{route('admin.quanly.addPro')}}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .content // Lấy CSRF token từ meta element
                    },
                    // chuyển dữ liệu mảng sang dạng JSON
                    body: JSON.stringify(productList)
                })
                .then(response => {
                        if (!response.ok) {
                            throw new Error('Mạng không phản hồi');
                        }
                        return response.json(); // Hoặc response.text(), response.blob(), tùy thuộc vào phản hồi dự kiến
                    })

                .then(data => {
                    // Xử lý phản hồi từ controller (ví dụ: thông báo thành công)
                    alert('Gửi dữ liệu thành công')
                })
                .catch(error => {
                    alert('Gửi dữ liệu thất bại');
                });
            });
    </script>
@endsection
