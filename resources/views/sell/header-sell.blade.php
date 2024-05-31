{{-- Header layout --}}
<nav class="navbar navbar-expand-md navbar-light bg-primary sticky-top ">
    <div class="navbar-left ">
        <h1>Logo</h1>
    </div>
    <div class="navbar-right">
        {{-- <button class="btn btn-outline-light" type="button"><i class="fas fa-shopping-cart"></i> Bán hàng</button>
        <button class="btn btn-outline-light" type="button"><i class="fas fa-truck"></i> Trả hàng</button> --}}
        <a href="{{route('admin.banhang.banhang-index')}}" type="button" class="btn btn-outline-light"><i class="fas fa-shopping-cart"></i> Bán hàng</a>
        <a href="{{route('admin.quanly.dodathang-index')}}" type="button" class="btn btn-outline-light"><i class="fas fa-truck"></i> Trả hàng</a>
        <a href="{{route('admin.quanly.manage-index')}}" type="button" class="btn btn-warning">Quản lý</a>
        <a href="{{route('dangnhap')}}" type="button" class="btn btn-success">Đăng xuất</a>
    </div>
</nav>
