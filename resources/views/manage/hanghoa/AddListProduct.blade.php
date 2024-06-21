@extends('layout.manage-master')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- CSS --}}
    <style>
        .hidden {
            display: none;
        }
    </style>

    {{-- HTML --}}
    <h1 class="mt-2 text-center" style="font-weight: bold;">HÓA ĐƠN NHẬP HÀNG</h1>

    <div class="container-addlist mt-5">
        <!-- Phần Cảnh Báo -->
        <div id="alertSuccess" class="alert alert-success hidden" role="alert">
            Hóa đơn đã được tạo thành công!
        </div>
        <form id="invoiceForm" action="" method="POST">
            @csrf
            <div class="row col-12">
                <div class="left-add col-5">
                    <label for="invoiceCode" class="col-sm-12 col-form-label">Nhà cung cấp</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="supplierSelect">
                            @foreach ($listDistributor as $item)
                                <option name="idNpp" value="{{ $item->id_nhaphanphoi }}">{{ $item->ten_nhaphanphoi }}
                                </option>
                            @endforeach
                            {{-- Thêm các tùy chọn khác ở đây nếu cần --}}
                        </select>
                        <button type="button" class="btn btn-primary mt-2" id="submitInvoice"
                            onclick="showProductButtons()">Tạo hóa đơn</button>
                        <hr>
                    </div>
                </div>
                <div class="rigth-add col-7">
                    <div class="form-group row">
                        <label for="invoiceCode" class="col-sm-2 col-form-label">Mã Hóa đơn</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="invoiceCode" name="invoiceCode" value=""
                                readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="invoiceDate" class="col-sm-2 col-form-label">Thời gian</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="invoiceDate" name="invoiceDate" value=""
                                readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="totalAmount" class="col-sm-2 col-form-label">Tổng tiền</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="totalAmount" name="totalAmount" value=""
                                readonly>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu hóa đơn</button>
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('admin.quanly.hanghoa-index') }}'">Hủy</button>
                </div>
            </div>
            <div id="productDetailsSection" class="hidden">
                <h4 style="font-weight: bold;">Chi tiết hóa đơn</h4>
                <button type="button" class="btn btn-primary mb-1" id="addRow" style="float: right;">Thêm dòng</button>
                <div class="table-responsive" style="margin-top: 5px;">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá nhập</th>
                                <th>Đơn vị</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody id="invoiceDetails">
                            {{-- Hiển thị item nhập hàng --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>

    {{-- Java Script --}}
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        // mảng JavaScript chứa thông tin sản phẩm
        var productData = @json($dataListPro);
        // var productData = JSON.parse(document.getElementById('productData').textContent);

        // ẩn bảng nhập hàng
        function showProductButtons() {
            document.getElementById('productDetailsSection').classList.remove('hidden');

            // Tạo mã hóa đơn và hiển thị thời gian thực
            var now = new Date();
            var invoiceCode = "HD" + now.getFullYear() +
                ("0" + (now.getMonth() + 1)).slice(-2) +
                ("0" + now.getDate()).slice(-2) +
                ("0" + now.getHours()).slice(-2) +
                ("0" + now.getMinutes()).slice(-2) +
                ("0" + now.getSeconds()).slice(-2) +
                ("00" + now.getMilliseconds()).slice(-3);
            document.getElementById('invoiceCode').value = invoiceCode;

            // Hiển thị thời gian thực của vùng Hà Nội
            var options = {
                timeZone: 'Asia/Ho_Chi_Minh',
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            var formatter = new Intl.DateTimeFormat([], options);

            // Lấy các phần tử của ngày giờ từ đối tượng Date
            var year = now.getFullYear();
            var month = String(now.getMonth() + 1).padStart(2, '0'); // Tháng bắt đầu từ 0, nên cần cộng thêm 1
            var day = String(now.getDate()).padStart(2, '0');
            var hours = String(now.getHours()).padStart(2, '0');
            var minutes = String(now.getMinutes()).padStart(2, '0');
            var seconds = String(now.getSeconds()).padStart(2, '0');

            // Tạo chuỗi ngày giờ theo định dạng "yyyy-MM-ddThh:mm"
            var formattedDateTime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
            console.log(formattedDateTime);
            // hiển thị chuỗi thời gian vừa được tạo
            document.getElementById('invoiceDate').value = formattedDateTime;
        }

        // Tính tổng giá trị nhập hàng
        function calculateTotalAmount() {
            let totalAmount = 0;
            document.querySelectorAll('.product-row').forEach(function(row) {
                let quantity = parseFloat(row.querySelector('input[name="products[][quantity]"]')
                    .value) || 0;
                let priceImport = parseFloat(row.querySelector('input[name="products[][priceImport]"]')
                    .value) || 0;
                totalAmount += quantity * priceImport;
            });
            document.getElementById('totalAmount').value = totalAmount.toFixed(
                2); // Hiển thị tổng tiền với 2 chữ số thập phân
        }

        // Thêm hàng
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('addRow').addEventListener('click', function() {
                var newRow = `
                        <tr id="eventCancel" class="product-row">
                            <td style="vertical-align: middle;">
                                <select class="form-control" name="products[][code]">
                                    <option value="">----Chọn mã sản phẩm----</option>
                                    @foreach ($dataListPro as $item)
                                        <option value="{{ $item->id_sanpham }}">{{ $item->ma_sanpham }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="text" class="form-control product-name" name="products[][name]" placeholder="Tên sản phẩm" readonly></td>
                            <td><input type="number" class="form-control " name="products[][quantity]" placeholder="Số lượng" step="1" min="0"></td>
                            <td><input type="number" class="form-control " name="products[][priceImport]" placeholder="Giá nhập" step="1" min="0"></td>
                            <td style="vertical-align: middle;">
                                <select class="form-control" name="products[][unit]">
                                    @foreach ($listLocals as $item)
                                        <option value="{{ $item->id_nhacungcap }}">{{ $item->ten_nhacungcap }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><button type="button" class="btn btn-danger removeRow" >🗑️</button></td>
                        </tr>`;
                document.getElementById('invoiceDetails').insertAdjacentHTML('beforeend',
                    newRow);
                addRemoveRowEvent();
                calculateTotalAmount(); // Tính lại tổng giá trị nhập hàng sau khi thêm hàng
            });

            // Xử lý sự kiện xóa bớt item
            function addRemoveRowEvent() {
                document.querySelectorAll('.removeRow').forEach(button => {
                    button.addEventListener('click', function() {
                        this.closest('tr').remove();
                        calculateTotalAmount(); // Tính lại tổng giá trị nhập hàng sau khi xóa hàng
                    });
                });

                document.querySelectorAll('select[name="products[][code]"]').forEach(function(select) {
                    select.addEventListener('change', function() {
                        var selectedProduct = productData.find(product => product
                            .id_sanpham == this
                            .value);
                        var row = this.closest('tr');
                        row.querySelector('.product-name').value = selectedProduct ? selectedProduct
                            .ten_sanpham : '';
                    });
                });
            }
            addRemoveRowEvent();
        });

        // Sự kiện nút "Hủy"
        document.querySelector('.btn-secondary').addEventListener('click', function() {
            document.getElementById('eventCancel').innerHTML = '';
        });

        // Gửi dữ liệu đến controller khi nhấp vào nút Submit
        document.getElementById('invoiceForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Ngăn chặn hành động submit mặc định

            // Thu thập dữ liệu sản phẩm và lưu vào mảng dữ liệu
            var products = [];
            document.querySelectorAll('.product-row').forEach(function(row) {
                var product = {
                    code: row.querySelector('select[name="products[][code]"]').value,
                    name: row.querySelector('input[name="products[][name]"]').value,
                    quantity: row.querySelector('input[name="products[][quantity]"]').value,
                    priceImport: row.querySelector('input[name="products[][priceImport]"]').value,
                    unit: row.querySelector('select[name="products[][unit]"]').value
                };
                products.push(product);
            });

            // Thu thập dữ liệu hóa đơn
            var invoiceData = {
                supplierId: document.getElementById('supplierSelect').value,
                invoiceCode: document.getElementById('invoiceCode').value,
                invoiceDate: document.getElementById('invoiceDate').value,
                totalAmount: document.getElementById('totalAmount').value,
                products: products,
            };

            console.log(invoiceData);

            // Gửi dữ liệu bằng fetch API
            fetch("{{ route('admin.quanly.addProduct') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify(invoiceData)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Phản hồi mạng không hợp lệ');
                    }   
                    return response.json();
                })
                .then(data => {
                    console.log('Success:', data);
                    // Xử lý phản hồi từ server
                    // Hiển thị thông báo thành công
                    var alertSuccess = document.getElementById('alertSuccess');
                    alertSuccess.classList.remove('hidden');
                    alertSuccess.scrollIntoView(); // Cuộn đến phần thông báo

                    // Reset form sau khi lưu thành công
                    document.getElementById('invoiceForm').reset();
                    document.getElementById('productDetailsSection').classList.add('hidden');
                    document.getElementById('invoiceDetails').innerHTML = '';
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        });

        // document.getElementById('submitInvoice').addEventListener('click', showProductButtons);
    </script>
    {{-- end --}}
@endsection
