@extends('layout.manage-master')

@section('content')
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.css' rel='stylesheet' />
    <script src="https://api.mapbox.com/mapbox-gljs/plugins/mapbox-gl-directions/v4.1.0/mapbox-gldirections.js"></script>
    <link rel="stylesheet"
        href="https://api.mapbox.com/mapboxgl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gldirections.css" type="text/css">
    <style>
        #map {
            width: 100%;
            height: 500px;
        }
    </style>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-danger card-img-holder text-white">
                        <div class="card-body">
                            <img src="{{ asset('css/overview/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                alt="circle-image" />
                            <h4 class="font-weight-normal mb-3">Doanh thu <i
                                    class="mdi mdi-chart-line mdi-24px float-right"></i>
                            </h4>
                            <h2 class="mb-5"> {{ number_format($totalMoney) }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-info card-img-holder text-white">
                        <div class="card-body">
                            <img src="{{ asset('css/overview/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                alt="circle-image" />
                            <h4 class="font-weight-normal mb-3">Tổng mặt hàng đã bán <i
                                    class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                            </h4>
                            <h2 class="mb-5">{{ number_format($totalDataProduct) }}</h2>
                       
                        </div>
                    </div>
                </div>
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-success card-img-holder text-white">
                        <div class="card-body">
                            <img src="{{ asset('css/overview/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                alt="circle-image" />
                            <h4 class="font-weight-normal mb-3">Lượng hàng tồn kho <i
                                    class="mdi mdi-diamond mdi-24px float-right"></i>
                            </h4>
                            <h2 class="mb-5">{{ number_format($totalData) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="clearfix">
                                <h4 class="card-title float-left">Vị trí cửa hàng</h4>
                                <div id="visit-sale-chart-legend"
                                    class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                                <div id="map"></div>
                                <script>
                                    // Your Mapbox access token
                                    mapboxgl.accessToken =
                                        'pk.eyJ1Ijoibmd1eWVudGh1aHVvbmcxOTg3IiwiYSI6ImNrb2Y4dXNlNTBqcmQzMXRyZXA3Yng2NDUifQ.VXut_atNnNAiiw5pi5PwDg';

                                    // Initialize the map
                                    const map = new mapboxgl.Map({
                                        container: 'map', // container ID
                                        style: 'mapbox://styles/mapbox/streets-v11', // style URL
                                        center: [105.809845, 21.036712], // starting position [lng, lat]
                                        zoom: 12 // starting zoom
                                    });

                                    var marker = new mapboxgl.Marker({
                                            color: "red", //Màu của Marker là đỏ
                                            draggable: true,
                                            anchor: 'bottom', //Nhãn Hà Nội nằm dưới Marker
                                        }).setLngLat([105.809845, 21.036712]) //Thiết lập Marker tại hà Nội
                                        .addTo(map);

                                    var popup = new mapboxgl.Popup({
                                            closeButton: true,
                                            closeOnClick: false,
                                            anchor: 'right',
                                        }).setLngLat([105.809845, 21.036712])
                                        .setHTML("<h4>Alex Sport</h4>")
                                        .addTo(map);

                                    map.addControl(
                                        new MapboxDirections({
                                            accessToken: mapboxgl.accessToken
                                        }),
                                        'top-left'
                                    );

                                    // Add zoom and rotation controls to the map.
                                    map.addControl(new mapboxgl.NavigationControl());
                                </script>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">mặt hàng bán chạy</h4>
                            <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th> &nbsp; </th>
                                                <th> Ảnh </th>
                                                <th> Sản phẩm </th>
                                                <th> Lượt bán </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($topProducts as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        <img src="{{ asset('images/' . $item->anh) }}" class="me-2"
                                                            alt="image">
                                                    </td>
                                                    <td> {{ $item->ten_sanpham }} </td>
                                                    <td> {{ $item->tongsoluongxuat }} </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                    <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright ©
                        bootstrapdash.com
                        2021</span>
                    <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> Free <a
                            href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin
                            template</a> from Bootstrapdash.com</span>
                </div>
            </footer>
            <!-- partial -->
        </div>
    @endsection
