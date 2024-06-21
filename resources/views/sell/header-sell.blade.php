{{-- Header layout --}}

<nav class="navbar navbar-expand-lg navbar-dark bg-primary p-3">
    <a class="navbar-brand" href="">Kiot</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="btn btn-outline-light" href="{{ route('admin.banhang.banhang-index') }}"><i
                        class="fas fa-shopping-cart"></i> Bán hàng</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-outline-light" href="{{ route('admin.quanly.dodathang-index') }}"><i
                        class="fas fa-truck"></i> Trả hàng</a>
            </li>
            <li class="nav-item">
                <a class=" btn btn-warning" href="{{ route('admin.quanly.overview-index') }}">Quản lý</a>
            </li>
            <li class="nav-item">
                @auth
                    <form id="logout-form" action="{{ route('logout') }}" method="post">
                        @csrf
                        <a class="btn btn-success" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a>
                    </form>
                @endauth
            </li>
        </ul>
    </div>
</nav>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
