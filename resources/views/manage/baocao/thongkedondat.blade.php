@extends('layout.manage-master')

@section('content')
    <div class="d-md-flex mt-3">
        <div class="left-order col-3 mb-4">
            <h2>Báo cáo kênh bán hàng</h2>
            <form id="search-form" method="POST" class="search-wrap">
                @csrf
                <div class="input-group my-auto">
                    <input type="text" name="phone" id="phone-input" class="form-control rounded-pill"
                        placeholder="Nhập số điện thoại..." aria-label="Search phone" aria-describedby="search-button">
                    <div class="input-group-append">
                        <button class="btn btn-success rounded-pill" type="submit" id="search-button">Tìm kiếm</button>
                    </div>
                </div>
            </form>
            <div class="time">
                <h3>Thời gian</h3>
            </div>
            <select name="select-times" id="select-times" class="select-order mt-2 w-100">
                <option id="thisDay" name="thisDay" value="thisDay">Hôm nay</option>
                <option id="thisMonth" name="thisMonth" value="thisMonth">Tháng này</option>
                <option id="thisYear" name="thisYear" value="thisYear">Năm này</option>
            </select>
        </div>
        <div class="right-order col-9 pl-4">
            <h2>Danh sách đặt hàng</h2>
            <div id="box">
                <table class="table table-striped">
                    <tbody id="data-container">
                        {{-- hiển thị dữ liệu --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search-form').on('submit', function(e) {
                e.preventDefault();
                var phone = $('#phone-input').val();
                searchInvoicesByPhone(phone);
            });

            $('#select-times').change(function() {
                var selectedOption = $(this).val();
                // console.log(selectedOption);
                displayData(selectedOption);
                // console.log(selectedOption);
            });

            // Xử lý chức năng tìm kiếm sản phẩm
            function searchInvoicesByPhone(phone) {
                $.ajax({
                    url: "{{ route('admin.quanly.search-invoice') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        phone: phone
                    },
                    success: function(response) {
                        displaySearchResults(response);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }

            function displaySearchResults(data) {
                $('#data-container').empty();
                const linkTraHang = `{{ route('admin.banhang.trahang-index', ['tra-hang-replace']) }}`
                $.each(data, function(index, item) {
                    var row = '<tr>' +
                        '<td>' + (index + 1) + '</td>' +
                        '<td>' +
                        `<a href="${linkTraHang.replace('tra-hang-replace', item.id_hoadonxuat)}" class="btn ">` +
                        item.ma_hoadonxuat +
                        '</a>' +
                        '</td>' +
                        '<td>' + item.sodienthoai + '</td>' +
                        '<td>' + item.thoigian + '</td>' +
                        '</tr>';
                    $('#data-container').append(row);
                });
            }

            function displayData(selectedOption) {
                var data = @json(compact('thisDay', 'thisMonth', 'thisYear'));
                var selectedData = data[selectedOption];
                // console.log(data);
                // Hiển thị dữ liệu tương ứng
                $('#data-container').empty();
                // $('#data-container').html(selectedData);
                const linkTraHang = `{{ route('admin.banhang.trahang-index', ['tra-hang-replace'])
                 }}`
                console.log(linkTraHang)
                $.each(selectedData, function(index, item) {
                    var row = '<tr>' +
                        '<td>' + (index + 1) + '</td>' +
                        '<td>' +
                        `<a href="${ linkTraHang.replace('tra-hang-replace', item
                        .id_hoadonxuat)}" class="btn ">` +
                        item.ma_hoadonxuat +
                        '</a>' +
                        '</td>' +
                        '<td>' + item.sodienthoai + '</td>' +
                        '<td>' + item.thoigian + '</td>' +
                        '</tr>';
                    $('#data-container').append(row);
                });
            }

            // Hiển thị dữ liệu mặc định khi trang được tải
            displayData('thisDay');
        });
    </script>
@endsection
