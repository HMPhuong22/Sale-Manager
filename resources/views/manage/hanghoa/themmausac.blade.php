@extends('layout.manage-master')

@section('content')
    <div class="container-size">
        <div class="row">
            {{-- Hiển thị danh sách size --}}
            <div class=" col-md-8 border-right px-5 py-4">
                <h3>Danh sách màu sắc</h3>
                <div class="mt-3">
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <div class="d-flex flex-row align-items-center"></div>
                    </div>
                    <div class="mt-3">
                        <p>
                            @foreach ( $listColor as $key => $item)
                                {{-- Phân loại kích thước --}}
                                <span class="btn-light p-1">{{$item->ten_mausac}}</span>                                  
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 px-5 py-4">
                <h4 class="mt-2">Thêm màu sắc</h4>
                <form action="" method="post">
                    @csrf
                    <div class="mt-5">
                        <div class="form-group">
                            <input type="text" name="nameColor" class="form-control-size" required>
                            <label class="form-control-placeholder" for="name">Màu sắc</label>
                        </div>
                        @error('nameColor')
                            <small style="color: red;">{{$message}}</small>
                        @enderror
                        <div class="ml-3 mt-2">
                            <div class="mt-1">
                                <button class="btn btn-success my-button">Lưu</button>
                            </div>
                            @if (session('msgColor'))
                                <p style="color: green;">{{ session('msgColor') }}</p>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
