document.addEventListener('DOMContentLoaded', function () {
    // mảng JavaScript chứa thông tin sản phẩm
    // var productData = @json($dataListPro);
    var productData = JSON.parse(document.getElementById('productData').textContent);

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
        var formattedDateTime = `${year}-${month}-${day}T${hours}:${minutes}:${seconds}`;

        // hiển thị chuỗi thời gian vừa được tạo
        document.getElementById('invoiceDate').value = formatter.format(now);
    }

    // Tính tổng giá trị nhập hàng
    function calculateTotalAmount() {
        let totalAmount = 0;
        document.querySelectorAll('.product-row').forEach(function (row) {
            let quantity = parseFloat(row.querySelector('input[name="products[][quantity]"]').value) || 0;
            let priceImport = parseFloat(row.querySelector('input[name="products[][priceImport]"]').value) || 0;
            totalAmount += quantity * priceImport;
        });
        document.getElementById('totalAmount').value = totalAmount.toFixed(
            2); // Hiển thị tổng tiền với 2 chữ số thập phân
    }

    // Thêm hàng
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('addRow').addEventListener('click', function () {
            var newRow = `
                        <tr id="eventCancel" class="product-row">
                            <td style="vertical-align: middle;">
                                <select class="form-control" name="products[][code]">
                                    @foreach ($dataListPro as $item)
                                        <option value="{{ $item->id_sanpham }}">{{ $item->ma_sanpham }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="text" class="form-control product-name" name="products[][name]" placeholder="Tên sản phẩm" readonly></td>
                            <td><input type="number" class="form-control " name="products[][quantity]" placeholder="Số lượng"></td>
                            <td><input type="text" class="form-control " name="products[][priceImport]" placeholder="Giá nhập"></td>
                            <td style="vertical-align: middle;">
                                <select class="form-control" name="products[][unit]">
                                    @foreach ($listLocals as $item)
                                        <option value="{{ $item->id_nhacungcap }}">{{ $item->ten_nhacungcap }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><button type="button" class="btn btn-danger removeRow" >🗑️</button></td>
                        </tr>`;
            document.getElementById('invoiceDetails').insertAdjacentHTML('beforeend', newRow);
            addRemoveRowEvent();
            calculateTotalAmount(); // Tính lại tổng giá trị nhập hàng sau khi thêm hàng
        });

        // Xử lý sự kiện xóa bớt item
        function addRemoveRowEvent() {
            document.querySelectorAll('.removeRow').forEach(button => {
                button.addEventListener('click', function () {
                    this.closest('tr').remove();
                    calculateTotalAmount(); // Tính lại tổng giá trị nhập hàng sau khi xóa hàng
                });
            });

            document.querySelectorAll('select[name="products[][code]"]').forEach(function (select) {
                select.addEventListener('change', function () {
                    var selectedProduct = productData.find(product => product.id_sanpham == this
                        .value);
                    var row = this.closest('tr');
                    row.querySelector('.product-name').value = selectedProduct ? selectedProduct
                        .ten_sanpham : '';
                });
            });
        }
        addRemoveRowEvent();
    });

    // Sự kiện nút "Cancel"
    document.querySelector('.btn-secondary').addEventListener('click', function () {
        document.getElementById('eventCancel').innerHTML = '';
    });

    // Gửi dữ liệu đến controller khi nhấp vào nút Submit
    document.getElementById('invoiceForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Ngăn chặn hành động submit mặc định

        // Thu thập dữ liệu sản phẩm và lưu vào mảng dữ liệu
        var products = [];
        document.querySelectorAll('.product-row').forEach(function (row) {
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

        // Gửi dữ liệu bằng AJAX
        fetch("{{ route('admin.quanly.addProduct') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(invoiceData)
        })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                // Xử lý phản hồi từ server
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    });

    document.getElementById('submitInvoice').addEventListener('click', showProductButtons);
})