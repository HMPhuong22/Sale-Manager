<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css\editpro.css') }}">
    <link rel="stylesheet" href="{{ asset('css\addproduct.css') }} ">
</head>

<body>
    {{-- update product --}}
    <div class="container d-flex justify-content-center my-5">
        <form action="{{ route('admin.quanly.postEdit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- <input type="hidden" name="idCheckUpdate" value="{{ $getUserDetail->id_sanpham }}"> --}}
            <div class="row my-2 mx-2 main">
                <!--left-column-->
                <div class="col-md-4 col-12 mycol">
                    <!--image-->
                    <div class="img">
                        <img src="{{ asset('images/' . $getUserDetail->anh) }}" width="300px" height="300px">
                        <input type="file" accept="image/*" name="newImage" class="mt-3" value="">
                    </div>
                </div>
                <!--right-column-->
                <div class="col-md-8 col-12 xcol">
                    <h2 class="title pt-5 pb-3">Cập nhật sản phẩm</h2>
                    <div class="form-group">
                        <label class="sr-only">Mã sản phẩm</label>
                        <span stype="">{{ $getUserDetail->ma_sanpham }}</span>
                    </div>
                    <div class="form-group">
                        <label class="sr-only">Tên sản phẩm</label>
                        <input type="text" name="newName" class="form-control" required=""
                            value="{{ old('newName') ?? $getUserDetail->ten_sanpham }}">
                        @error('newName')
                            <small style="color: red;">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="sr-only">Hãng</label>
                        <select name="newLocal" class="form-control">
                            @if (!empty($getListLocal))
                                @foreach ($getListLocal as $key => $item)
                                    <option name="newLocal" value="{{ $item->id_nhacungcap }}">
                                        {{ $item->ten_nhacungcap }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="sr-only">Kích thước</label>
                        <select name="newSize" class="form-control">
                            @if (!empty($getListSize))
                                @foreach ($getListSize as $key => $item)
                                    <option name="newSize" value="{{ $item->id_kichthuoc }}">
                                        {{ $item->ten_kichthuoc }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="sr-only">Loại sản phẩm</label>
                        <select name="newCategory" class="form-control">
                            @if (!empty($getListCategory))
                                @foreach ($getListCategory as $key => $item)
                                    <option name="newCategory" value="{{ $item->id_loaihang }}">
                                        {{ $item->ten_loaihang }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="sr-only">Danh mục</label>
                        <select name="newMenu" class="form-control">
                            @if (!empty($getListMenu))
                                @foreach ($getListMenu as $key => $item)
                                    <option name="newMenu" value="{{ $item->id_danhmucsanpham }}">
                                        {{ $item->ten_danhmucsanpham }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="sr-only">Giá</label>
                        <input type="text" name="newPrice" class="form-control" required=""
                            value="{{ old('newPrice') ?? $getUserDetail->gia }}">
                        @error('newPrice')
                            <small style="color: red;">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="sr-only">Số lượng</label>
                        <input type="text" name="newQuantity" class="form-control" 
                            value="{{ old('newQuantity') ?? $getUserDetail->soluong }}">
                        @error('newQuantity')
                            <small style="color: red;">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="sr-only">Mô tả</label>
                        <textarea type="text" name="newDescription" class="form-control" value="{{ $getUserDetail->mota }}">{{ old('newDescription') ?? $getUserDetail->mota }}</textarea>
                    </div>
                    <button type="submit" class="btn text-center text-light btn-blue mt-3 mb-3">Cập nhật sản
                        phẩm</button>
                    <a href="{{ route('admin.quanly.hanghoa-index') }}" type="btn btn-succes">Quay lại trang sản
                        phẩm</a>
                </div>
            </div>
        </form>
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
