@extends('layout.manage-master')


@section('content')
    {{-- sidebar --}}
    <div class="d-md-flex mt-3">
        <div class="left-order col-3 mb-4">
            <h2>Báo cáo kênh bán hàng</h2>
            <div class="time">
                <h3>Thời gian</h3>
            </div>
            <form action="" method="post">
                <select name="" id="" class="select-order mt-2 w-100">
                    <option value="">Hôm nay</option>
                    <option value="">Tháng này</option>
                    <option value="">Năm này</option>
                </select>
            </form>
        </div>
            {{-- navbar --}}
    <table class="table table-condensed">
        <thead>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>Tổng thu</th>
            <th>Tổng chi</th>
            <th>Tồn quỹ</th>
        </thead>
        <tbody>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td class="text-success">565.778 <i class="fa fa-arrow-up"></i></td>
                <td class="text-warning">12.334.222 <i class="fa fa-arrow-down"></i></td>
                <td class="text-danger">12.900.000</td>
            </tr>
        </tbody>
    </table>
    </div>
    @endsection
