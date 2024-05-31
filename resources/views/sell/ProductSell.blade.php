@if (Session::has('Sell') != null)
    @foreach (Session::get('Sell')->products as $key => $item)
        <tr>
            <td>{{ $item['productInf']->ten_sanpham }} - {{$item['productInf']->ten_kichthuoc}}</td>
            {{-- <td>{{$item['productInf']->id_kichthuoc}}</td> --}}
            <td>{{ number_format($item['productInf']->gia) }}</td>
            <td><input type="number" style="width: 20%" value="{{ $item['quanty'] }}"></td>
            <td><span>{{ number_format($item['gia']) }}</span></td>
            <td class="si-close">
                <a onclick="handleClick(event)" data-id="{{ $item['productInf']->id_sanpham }}" href="javascript:">Xóa</a>
            </td>
        </tr>
        <input id="total-price" type="hidden" value="{{Session::get('Sell')->totalPrice}}">
        <input id="total-quantity" type="hidden" value="{{Session::get('Sell')->totalQuatity}}">
    @endforeach
@endif
