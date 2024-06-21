@extends('layout.manage-master')


@section('content')
    {{-- STYLE --}}
    <style>
        .stat-box {
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .stat-box h3 {
            margin: 0;
            font-size: 1.2em;
        }

        .stat-box p {
            margin: 0;
            font-size: 1.5em;
            color: #007bff;
        }
    </style>
    {{-- END STYLE --}}
    {{-- sidebar --}}
    <div class="d-md-flex mt-3">
        <div class="left-order col-3 mb-4">
            <h2>Báo cáo kênh bán hàng</h2>
            <div class="time">
                <h3>Thời gian</h3>
            </div>
            <select id="select-type-chart" class="mb-3 mt-2 w-100">
                <option value="month">Tháng</option>
                <option value="quarter">Quý</option>
                <option value="year">Năm</option>
            </select>
        </div>
        {{-- navbar --}}

        <div class="right-order w-100 row ml-5">
            <div class="col-12">
                {{-- Hiển thị số lượng đơn hàng và tổng doanh thu --}}
                <h2>Hôm nay</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="stat-box">
                            <h3>Số lượng đơn hàng</h3>
                            <p><a id="total-orders" href="{{route('admin.quanly.dodathang-index')}}">{{$totalOrders}}</a></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-box">
                            <h3>Tổng doanh thu</h3>
                            <p id="total-revenue">{{number_format($totalRevenue)}} VND</p>
                        </div>
                    </div>
                </div>

                {{-- thống kê đơn hàng và tiền bán --}}
                <h2>Thống kê chi tiết</h2>
                <div id="container-chart1">
                    <canvas id="chart1"></canvas>
                </div>
            </div>
            <div class="col-12 mt-5 row justify-content-center">
                <div class="col-6">
                    <canvas id="chart2"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // const start = document.getElementById('startTime').value;
        // const end = document.getElementById('endTime').value;

        // console.log(start);

        // tạo biến chứa phần vùng hiển thị dữ liệu
        const containerChart1 = document.getElementById('container-chart1')
        const ctx2 = document.getElementById('chart2');
        // sử lý sự kiện dropbox
        const selectTypeChart = document.getElementById('select-type-chart')
        // tạo biến lưu dữ liệu đươc chuyển từ dạng dữ liệu PHP sang JSON
        const dataOutputForm = JSON.parse('{!! json_encode($allOuputForm) !!}')
        const data1 = JSON.parse('{!! json_encode($totalAmountByLoaiHang) !!}')

        // trích xuất chuỗi dầu vào sang dạng số
        function extractNumbersFromString(str) {
            return str.match(/\d+/g).join('');
        }

        function groupDataBy(data, groupBy) {
            const grouped = {};

            data.forEach(item => {
                console.log(item.thoigian);
                const date = new Date(item.thoigian);
                let key;

                switch (groupBy) {
                    case 'month':
                        const m = '2024-05';
                    key = m; // Month in JS is 0-indexed
                        // key = `${date.getFullYear()}-Th${date.getMonth() + 1}`; // Month in JS is 0-indexed
                        break;
                    case 'quarter':
                        const month = date.getMonth() + 1;
                        // const month = '2024-05';
                        const quarter = Math.ceil(month / 3);
                        key = `${date.getFullYear()}-Q${quarter}`;
                        key = month;
                        break;
                    case 'year':
                        key = date.getFullYear();
                        break;
                    default:
                        key = '';
                        break;
                }

                if (!grouped[key]) {
                    grouped[key] = [];
                }

                grouped[key].push(item);
            });

            // Creating a new object to store the sorted groups
            const sortedGrouped = {};

            // Sorting keys and populating the new object in sorted order
            Object.keys(grouped).sort((a, b) => {
                const partsA = a.split('-');
                const partsB = b.split('-');
                const yearA = parseInt(partsA[0], 10);
                const yearB = parseInt(partsB[0], 10);
                const monthA = partsA[1] ? extractNumbersFromString(partsA[1]) :
                    0; // Default to 0 for year-only keys
                const monthB = partsB[1] ? extractNumbersFromString(partsB[1]) :
                    0; // Default to 0 for year-only keys

                console.log(a, b, yearA, yearB, monthA, monthB);
                if (yearA !== yearB) {
                    return yearA - yearB;
                } else {
                    return monthA - monthB;
                }
            }).forEach(key => {
                sortedGrouped[key] = grouped[key];
            });

            return sortedGrouped;
        }

        const calculateRevenue = (listOrder = []) => {
            return listOrder.reduce((total, curr) => {
                return total + (curr.giaxuat * curr.soluong)
            }, 0)
        }


        const drawChart = (typeChart = "month") => {
            // Group by month
            const grouped = groupDataBy(dataOutputForm, typeChart);

            Object.keys(grouped).forEach(keyGroup => {
                grouped[keyGroup] = calculateRevenue(grouped[keyGroup])
            })

            console.log(Object.values(grouped).reduce((total, curr) => total + curr, 0));

            containerChart1.querySelector('#chart1')?.remove()
            containerChart1.innerHTML = ` <canvas id="chart1"></canvas>`
            const ctx1 = document.getElementById('chart1');

            new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: Object.keys(grouped),
                    datasets: [{
                        label: 'doanh thu',
                        data: Object.values(grouped),
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        title: {
                            position: 'bottom',
                            display: true,
                            text: `Biểu đồ thống kê doanh thu theo ${typeChart === 'month' ? 'tháng' : typeChart === 'quarter' ? 'quý' : 'năm'}`
                        }
                    }
                },
            });
        }

        drawChart()

        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: Object.keys(data1),
                datasets: [{
                    label: 'doanh thu',
                    data: Object.values(data1).map(dataValue => dataValue.value),
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        position: 'bottom',
                        display: true,
                        text: `Biểu đồ thống kê doanh thu theo loại sản phẩm`
                    }
                }
            },
        });

        selectTypeChart.onchange = (e) => {
            drawChart(e.currentTarget.value)
        }
    </script>
@endsection
