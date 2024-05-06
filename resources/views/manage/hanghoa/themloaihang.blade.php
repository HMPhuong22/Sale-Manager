@extends('layout.manage-master')

@section('content')
    <div class="add-category d-flex justify-content-center">                                                                                                                          
        <form action="" method="POST" class="form container-fluid mt-5">
            @csrf
            <div class="form-group">
                <label class="sr-only">Mã loại hàng: </label>
                <input type="text" class="form-control" required="" name="idCate" placeholder="Mã loại hàng">
                @error('idCate')
                    <p style="color: red;">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label class="sr-only">Tên loại hàng: </label>
                <input type="text" class="form-control" required="" name="nameCate" placeholder="Tên loại hàng">
                @error('nameCate')
                    <p style="color: red;">{{$message}}</p>
                @enderror
            </div>
            <button type="submit" class="btn text-center btn-success">Lưu</button>
            @if (session('msgCate'))
                <p style="color: green;">{{session('msgCate')}}</p>
            @endif
        </form>
    </div>
@endsection