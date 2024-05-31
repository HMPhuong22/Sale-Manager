@extends('layout.manage-master')
@section('content')
    <div class="container mt-5">
        <h2>Thêm sản phẩm</h2>
        <hr>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="left-add col-7">
                    @csrf
                    <div class="form-group">
                        <label class="sr-only">Mã sản phẩm</label>
                        <input type="text" class="form-control" required name="idProduct"
                        placeholder="Mã sản phẩm...">
                    </div>
                    @error('idProduct')
                        <small style="color:red;">{{ $message }}</small>
                    @enderror
                    <div class="form-group">
                        <label class="sr-only">Tên sản phẩm</label>
                        <input type="text" class="form-control" required="" name="nameProduct"
                            placeholder="Tên sản phẩm...">
                    </div>
                    @error('nameProduct')
                        <p style="color:red;">{{ $message }}</p>
                    @enderror
                    <div class="form-group">
                        <label class="sr-only">Hãng sản xuất</label>
                        <select name="local" class="form-control">
                            @if (!empty($listLocals))
                                @foreach ($listLocals as $key => $item)
                                    <option name="local" value="{{ $item->id_nhacungcap }}">{{ $item->ten_nhacungcap }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="sr-only">Loại sản phẩm</label>
                        <select name="category" class="form-control">
                            @if (!empty($listCate))
                                @foreach ($listCate as $key => $item)
                                    <option name="category" value="{{ $item->id_loaihang }}">{{ $item->ten_loaihang }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="sr-only">Danh mục sản phẩm</label>
                        <select name="menu" class="form-control">
                            @if (!empty($listMenu))
                                @foreach ($listMenu as $key => $item)
                                    <option name="menu" value="{{ $item->id_danhmucsanpham }}">
                                        {{ $item->ten_danhmucsanpham }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="sr-only">Kích thước</label>
                        <select name="size" class="form-control">
                            @if (!empty($listSize))
                                @foreach ($listSize as $key => $item)
                                    <option name="size" value="{{ $item->id_kichthuoc }}">{{ $item->ten_kichthuoc }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="sr-only">Số lượng</label>
                        <input type="text" class="form-control" required="" name="quantity" placeholder="Số lượng...">
                    </div>
                    @error('quantity')
                        <p style="color:red;">{{ $message }}</p>
                    @enderror
                    <div class="form-group">
                        <label class="sr-only">Giá</label>
                        <input type="text" class="form-control" required="" name="price" placeholder="Giá...">
                    </div>
                    @error('price')
                        <p style="color:red;">{{ $message }}</p>
                    @enderror
                    <div class="form-group">
                        <label class="sr-only">Mô tả</label>
                        <textarea class="form-control" rows="2" name="describe" placeholder="Mô tả sản phẩm..."></textarea>
                    </div>
                </div>

                <div class="right col-5">
                    <label for="">Ảnh sản phẩm</label>
                    <div class="py-20 h-screen px-2">
                        <div class="max-w-md mx-auto rounded-lg overflow-hidden md:max-w-xl">
                            <div class="md:flex">
                                <div class="w-full p-3">
                                    <div
                                        class="relative border-dotted h-48 rounded-lg border-dashed border-2 border-blue-700 bg-gray-100 flex justify-center items-center">
                                        <div class="absolute">
                                            <div class="flex flex-col items-center">
                                                <i class="fa fa-folder-open fa-4x text-blue-700"></i>
                                                <span class="block text-gray-400 font-normal">Thêm ảnh tại đây</span>
                                            </div>
                                        </div>
                                        <input type="file" class="h-full w-full opacity-0" accept="image/*" name="image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="add-product" id="bouncebutton"
                        class="btn btn-success btn-icon-text bouncebutton">
                        <i class="fa fa-check btn-icon-prepend"></i>
                        Lưu sản phẩm
                    </button>
                    @if(session('msgAddPro'))
                        <p style="color: green">{{session('msgAddPro')}}</p>
                    @endif
                    <a href="{{ route('admin.quanly.hanghoa-index') }}" type="button" name="add-product" id=""
                        class="btn btn-primary btn-icon-text bouncebutton">
                        <i class="fas fa-undo-alt"></i>
                        Quay lại    
                    </a>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            // Bounce button
            $("#bouncebutton").click(function() {
                const element = document.querySelector('.bouncebutton');
                element.classList.add('animated', 'bounce');
                setTimeout(function() {
                    element.classList.remove('bounce');
                }, 2000);
            });
        });
    </script>
@endsection
