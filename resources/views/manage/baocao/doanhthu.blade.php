@extends('layout.manage-master')


@section('content')
    {{-- sidebar --}}
    <div class="d-md-flex mt-3">
        <div class="left-order col-3 mb-4">
            <h2>Báo cáo kênh bán hàng</h2>
            <div class="time">
                <h3>Thời gian</h3>
            </div>
            <form action="" method="post">
                <select name="" id="" class="select-order mt-2 w-100">
                    <option value="">Hôm nay</option>
                    <option value="">Tháng này</option>
                    <option value="">Năm này</option>
                </select>
            </form>
        </div>
            {{-- navbar --}}

        <div>

            <canvas id="chart2"></canvas>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chart2');
        const data1 = JSON.parse('{!! json_encode($totalAmountByLoaiHang) !!}')

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: Object.keys(data1),
                datasets: [{
                    label: 'doanh thu',
                    data: Object.values(data1).map(dataValue => dataValue.value),
                }]
            },
        });
    </script>
    @endsection
