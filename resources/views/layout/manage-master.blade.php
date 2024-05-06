<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quản lý</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css\layout_quanly.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css\addproduct.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css\order.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css\layout_soquy.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css\addcate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css\size.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css\menu.css') }}">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body>
    {{-- header --}}
    <div id="header-page" class="sticky-top">
        <header class="bg-light">
            <a class="navbar-brand" href="#">
                <img src="https://tse4.mm.bing.net/th?id=OIP.agKfe9NStBGxWVW_6kThCQAAAA&pid=Api&P=0&h=220"
                    width="30" height="30" class="d-inline-block align-top" alt="">
                Kiot Viet
            </a>
        </header>
        {{-- navbar --}}
        <nav class="navbar navbar-expand-sm bg-primary">
            <ul class="navbar-nav d-flex align-items-center justify-content-end" style="height: 100%">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.quanly.manage-index') }}"
                        style="font-size: 1.5em"><i class="fas fa-eye"></i>
                        Tổng
                        quan</a>
                </li>
                <li class="nav-item ml-3">
                    <a class="nav-link text-white" href="{{ route('admin.quanly.hanghoa-index') }}"
                        style="font-size: 1.5em"><i class="fas fa-box"></i>
                        Hàng
                        hóa</a>
                </li>
                <li class="dropdown nav-item ml-3">
                    <a class="dropbtn nav-link text-white" href=""
                        style="font-size: 1.5em"><i class="fas fa-dollar-sign"></i> Đối tác</a>
                        <div class="dropdown-content">
                            <a href="{{ route('admin.quanly.khachhang-index') }}">Khách hàng</a>
                            <a href="{{ route('admin.quanly.doitac-index') }}">Đối tác</a>
                        </div>
                </li>
                <li class="dropdown nav-item ml-3">
                    <a class="dropbtn nav-link text-white" href="#" style="font-size: 1.5em"><i
                            class="fas fa-chart-bar"></i>
                        Báo cáo</a>
                    <div class="dropdown-content">
                        <a href="{{ route('admin.quanly.dodathang-index') }}">Thống kê đơn đặt</a>
                        <a href="{{ route('admin.quanly.doanhthu-index') }}">Doanh thu</a>
                    </div>
                </li>
            </ul>
            <div class="form-inline">
                <a href="{{ route('admin.banhang.banhang-index') }}" class="btn btn-success" id="btn-banhang" style="button"><i
                        class="fa-regular fa-cart-shopping"></i> Bán hàng</a>
            </div>
        </nav>
    </div>
    {{-- Content Main --}}
    <div class="container-fluid">
        @yield('search-product')
        @yield('content')
    </div>
    </div>
    @yield('footer-content')
</body>

</html>