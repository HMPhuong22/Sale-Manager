@extends('layout.manage-master')

@section('content')
    <div class="add-category d-flex justify-content-center">                                                                                                                          
        <form action="" method="POST" class="form container-fluid mt-5">
            @csrf
            <div class="input-group-menu">
                <input type="text" class="input-menu" required name="nameMenu" id="name"/>
                <label for="name" class="input-label-menu">Tên danh mục</label>
                @error('nameMenu')
                    <p style="color: red;">{{$message}}</p>
                @enderror
                @if (session('msgMenu'))
                    <p style="color: green">{{session('msgMenu')}}</p>
                @endif
                <button type="submit" class="btn btn-success mt-3">Lưu</button>
            </div>
        </form>
    </div>
@endsection
