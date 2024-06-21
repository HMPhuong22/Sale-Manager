<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản Kiot</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/layout_nganhhang.css')}}">
</head>

<body>
    <div class="container text-center">
        <h1>Đăng ký tài khoản Kiot</h1>
        <p>Chọn ngành hàng kinh doanh</p>
        <div class="row justify-content-center">
            <div class="col-md-5 col-12 business-category">
                <div class="icon-container">
                    <img src="https://via.placeholder.com/50" alt="Bán buôn, bán lẻ" class="icon">
                </div>
                <h3>Bán buôn, bán lẻ</h3>
                <ul class="list-unstyled">
                    <li><a href="{{route("dangky")}}"><i class="fa fa-check-circle"></i> Thời trang</a></li>
                    <li><a href=""><i class="fa fa-check-circle"></i> Tạp hóa, siêu thị</a></li>
                    <li><a href=""><i class="fa fa-check-circle"></i> Nhà thuốc</a></li>
                    <li><a href=""><i class="fa fa-check-circle"></i> Sách và văn phòng phẩm</a></li>
                </ul>
            </div>
            <div class="col-md-5 col-12 business-category">
                <div class="icon-container">
                    <img src="https://via.placeholder.com/50" alt="Ăn uống, giải trí" class="icon">
                </div>
                <h3>Ăn uống, giải trí</h3>
                <ul class="list-unstyled">
                    <li><a href=""><i class="fa fa-check-circle"></i> Nhà hàng</a></li>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.8.2/js/all.js"></script>
</body>

</html>
