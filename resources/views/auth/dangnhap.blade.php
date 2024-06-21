<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/styleLoginForm.css') }}">
</head>

<body>

    {{-- Form đăng nhập --}}
    {{-- 
        <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Sign Up</button>

        <div id="id01" class="modal">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span> --}}

    <form class="modal-content" action="" method="POST">
        @csrf
        <div class="container">
            <h1>Đăng nhập</h1>
            <hr>
            <label for="login-name"><b>Tên đăng nhập</b></label>
            <input type="text" placeholder="Nhập email\số điện thoại..." name="login-name" required>

            <label for="pass"><b>Mật khẩu</b></label>
            <input type="password" placeholder="Nhập mật khẩu..." name="pass" required>

            <p><a href="{{ route('dangky') }}" style="color:dodgerblue">Tạo tài khoản mới ở đây.</a></p>

            <div class="clearfix">
                {{-- <input type="hidden" name="action" value="{{ isset($_GET['action']) ? $_GET['action'] : '' }}"> --}}
                <button type="submit" class="cancelbtn" name="manage" value="manage">Quản lý</button>
                <button type="submit" class="signupbtn" name="sell" value="sell">Bán hàng</button>
            </div>
            @if (session('msg'))
                <p style="color: green">{{session('msg')}}</p>
            @endif
        </div>
    </form>

    </div>

    {{-- <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
        }
        </script> --}}

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
