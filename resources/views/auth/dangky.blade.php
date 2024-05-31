<!doctype html>
<html lang="en">

<head>
    <title>Đăng Ký</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="stylesheet" href="{{asset('css/styleLoginForm.css')}}">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <div class="container">
        <section class="vh-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 px-0 d-none d-sm-block">
                        <img src="https://product.hstatic.net/200000145547/product/z2391313157348_204e33254f93c928bdd07a1e2026ca9f_7ce8628b8ef541e598a27963b691fdc3_master.jpg"
                            alt="Login image" class="w-85 vh-100" style="object-fit: cover; object-position: left;">
                    </div>

                    <div class="col-sm-6 text-black">

                        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                            <form action="" style="width: 23rem;" method="POST">
                                @csrf
                                <h3 class="fw-large mb-3 pb-3" style="text-align: center; font-size:3em;">Thời trang
                                </h3>
                                <div class="fw-normal mb-3 pb-3" style="text-align: center;"><a href="">Chọn
                                        ngành hàng khác</a></div>

                                <div class="form-outline mb-4">
                                    <input type="text" id="form2Example18" placeholder="Tên đăng nhập"
                                        name="name-signin" class="form-control form-control-lg" value="{{old('name-signin')}}"/>
                                    @error('name-signin')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="text" id="form2Example28" placeholder="Số điện thoại"
                                        name="sdt-signin" class="form-control form-control-lg" value="{{old('sdt-signin')}}"/>
                                    @error('sdt-signin')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="form2Example28" placeholder="Mật khẩu" name="password"
                                        class="form-control form-control-lg"/>
                                    @error('password')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="form2Example28" placeholder="Nhập lại mật khẩu"
                                        name="password_confirmation" class="form-control form-control-lg" />
                                    @error('password_confirmation')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="pt-1 mb-4 d-flex justify-content-end">

                                    <div class="pt-1 mb-4 text-end">
                                        {{-- <button id="quay_lai" class="btn btn-info btn-lg btn-block custom-button" type="button">Đến trang đăng nhập</button> --}}
                                        <a href="{{ route('dangnhap') }}" id="quay_lai"
                                            class="btn btn-info btn-lg btn-block custom-button" type="button">Đến trang
                                            đăng nhập</a>
                                    </div>

                                    <div class="pt-1 mb-4 text-end">
                                        <button id="dang_ky" class="btn btn-info btn-lg btn-block custom-button"
                                            type="submit">Đăng ký</button>
                                    </div>
                                    <style>
                                        .custom-button {
                                            border-radius: 30px;
                                        }

                                        #dang_ky {
                                            color: white;
                                        }

                                        #quay_lai {
                                            background-color: white;
                                            color: #3dd5f3;
                                        }
                                    </style>
                                </div>
                            </form>

                        </div>

                    </div>

                </div>
            </div>
        </section>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
