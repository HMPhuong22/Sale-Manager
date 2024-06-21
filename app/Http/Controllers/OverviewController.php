<?php

namespace App\Http\Controllers;

use App\Models\OutputForm;
use App\Models\Product;
use App\Models\Time;
use App\Models\Overview;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OverviewController extends Controller
{
    protected $dataOutpuForm;
    public function __construct()
    {
        $this->dataOutpuForm = new OutputForm();
    }
    // index
    public function indexOverview(){
        // lấy dữ liệu về thời gian
        $time = new Time();
        $month = $time->GetMonth();
        $year = $time->GetYear();

        // dữ liệu về tiền bán hàng
        $getMoney = $this->dataOutpuForm->totalSellByMonth($year, $month);
        $totalMoney = $getMoney[0]->total_money;

        // dữ liệu sản phẩm được bán
        $getDataProduct = $this->dataOutpuForm->getTotalProduct($year, $month);
        $totalDataProduct = $getDataProduct[0]->total_product;

        // tổng lượng hàng tồn kho
        $pro = new Product();
        $getData = $pro->getInventory();
        $totalData = $getData[0]->total_quantity_product;

        // lấy ra top 5 sản phẩm bán chạy nhất
        $topProducts = Product::select('tbl_sanpham.anh', 'tbl_sanpham.ten_sanpham', DB::raw('SUM(tbl_chitiethdx.soluong) as tongsoluongxuat'))
            ->join('tbl_chitiethdx', 'tbl_sanpham.id_sanpham', '=', 'tbl_chitiethdx.id_sanpham')
            ->groupBy('tbl_sanpham.anh', 'tbl_sanpham.ten_sanpham')
            ->orderByDesc('tongsoluongxuat')
            ->limit(5)
            ->get();

        // lấy ra top 5 khách hàng thân thiết nhất
        $data = new Overview();
        $getData = $data->topCustomersByMonth($year ,$month);

        return view('manage.tongquan', compact('totalMoney', 'totalDataProduct', 'totalData', 'topProducts', 'getData'));
    }
}