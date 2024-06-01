@extends('layout.manage-master')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<form id="productForm" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <div class="m-3">
            <button type="button" class="btn btn-secondary" onclick="addProductRow()">Thêm sản phẩm</button>
            <button id="saveProducts" type="submit" class="btn btn-primary">Lưu sản phẩm</button>
        </div>

        <div class="dynamic-product-rows row">
            {{-- Product rows will be appended here --}}
        </div>
    </div>
</form>

<script>
    function addProductRow() {
        const productRowTemplate = `
        <div class="product-row bg-white col-md-12 p-3 mt-2 mb-2 rounded">
            <div class="form-row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="products[][name]" placeholder="Tên sản phẩm" required>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="products[][code]" placeholder="Mã sản phẩm" required>
                </div>
                <div class="col-md-2">
                    <input type="number" step="0.01" class="form-control" name="products[][price]" placeholder="Giá" required>
                </div>
                <div class="col-md-1">
                    <input type="number" step="0.01" class="form-control" name="products[][quantity]" placeholder="Số lượng" required>
                </div>
                <div class="col-md-3">
                    <input type="file" class="form-control" accept="image/*" name="products[][image]">
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="products[][size]" required>
                        @foreach ($listSize as $item)
                            <option value="{{ $item->id_kichthuoc }}">{{ $item->ten_kichthuoc }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="products[][category]" required>
                        @foreach ($listCate as $item)
                            <option value="{{ $item->id_loaihang }}">{{ $item->ten_loaihang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="products[][local]" required>
                        @foreach ($listLocals as $item)
                            <option value="{{ $item->id_nhacungcap }}">{{ $item->ten_nhacungcap }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="products[][menu]" required>
                        @foreach ($listMenu as $item)
                            <option value="{{ $item->id_danhmucsanpham }}">{{ $item->ten_danhmucsanpham }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <textarea class="form-control" name="products[][description]" rows="3" placeholder="Mô tả"></textarea>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger mt-2" onclick="deleteProductRow(this)">Xóa</button>
                </div>
            </div>
        </div>
        `;
        const productRows = document.querySelector('.dynamic-product-rows');
        const newProductRow = document.createElement('div');
        newProductRow.innerHTML = productRowTemplate;
        productRows.appendChild(newProductRow);
    }

    function deleteProductRow(button) {
        const productRow = button.closest('.product-row');
        productRow.remove();
    }

    document.getElementById('saveProducts').addEventListener('click', function(e) {
        e.preventDefault();

        const productForm = document.getElementById('productForm');
        const formData = new FormData(productForm);

        fetch("{{ route('admin.quanly.addProduct') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert('Gửi dữ liệu thành công');
        })
        .catch(error => {
            alert('Gửi dữ liệu thất bại');
        });
    });
</script>
@endsection
