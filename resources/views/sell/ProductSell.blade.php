@if ($newSell != null)
    @foreach ($newSell->products as $key => $item)
        <tr>
            <td>{{$item['productInf']->ten_sanpham}}</td>
            <td>{{$item['productInf']->ten_kichthuoc}}</td>
            <td>{{number_format($item['productInf']->gia)}} x{{$item['quanty']}}</td>
            <td class="si-close">
                <a onclick="handleClick(event)" href="javascript:" >Xóa</a>
            </td>
        </tr>
    @endforeach
    <div class="totalPrice">
        {{-- <h1>{{$newSell->totalPrice}}tổng giá đơn hàng</h1> --}}
    </div>
@endif  