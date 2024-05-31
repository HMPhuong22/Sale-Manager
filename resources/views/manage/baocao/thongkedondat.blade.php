@extends('layout.manage-master')

@section('content')
    <div class="d-md-flex mt-3">
        <div class="left-order col-3 mb-4">
            <h2>Báo cáo kênh bán hàng</h2>
            <form action="#" class="search-wrap">
                <div class="form-group">
                    <input type="search" class="form-control search bg-white" placeholder="Tìm kiếm theo số điện thoại...">
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
            $('#select-times').change(function() {
                var selectedOption = $(this).val();
                // console.log(selectedOption);
                displayData(selectedOption);
                // console.log(selectedOption);
            });

            function displayData(selectedOption) {
                var data = @json(compact('thisDay', 'thisMonth', 'thisYear'));
                var selectedData = data[selectedOption];
                // console.log(data);
                // Hiển thị dữ liệu tương ứng
                $('#data-container').empty();
                // $('#data-container').html(selectedData);
                $.each(selectedData, function(index, item) {
                    var row = '<tr>' +
                        '<td>' + (index + 1) + '</td>' +
                        '<td>' +
                        '<form action="{{ route('admin.banhang.trahang-index') }}" method="POST">' +
                        '@csrf' +
                        '<input type="hidden" name="mahoadonxuat" value="' + item.id_hoadonxuat + '">' +
                        '<button type="submit" class="btn btn-link">' + item.ma_hoadonxuat + '</button>' +
                        '</form>' +
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
