<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\OutputForm;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    //
    public function indexSales(){
        // lấy dữ liệu về thời gian
        $time = new Time();
        $day = $time->GetDay();

        $getData = new OutputForm();
        $data = $getData->getDataOrderByDay($day);
        $totalOrders = $data[0]->total_orders;
        $totalRevenue = $data[0]->total_revenue;

        $totalAmountByLoaiHang = [];
        for ($i = 1; $i<=3; $i++) {
            $loaiHang = Category::query()->where("id_loaihang", $i)->first();
            $totalAmountByLoaiHang[$loaiHang->ten_loaihang] = DB::table('tbl_chitiethdx')
                ->join('tbl_sanpham', 'tbl_chitiethdx.id_sanpham', '=', 'tbl_sanpham.id_sanpham')
                ->select(DB::raw('SUM(tbl_chitiethdx.soluong * tbl_chitiethdx.giaxuat) as value'))
                ->where('tbl_sanpham.id_loaihang', '=', $i)
                ->first();
        }

        $allOuputForm = OutputForm::query()
            ->join('tbl_chitiethdx', 'tbl_chitiethdx.id_hoadonxuat', '=', 'tbl_hoadonxuat.id_hoadonxuat')
            ->get();

        return view('manage.baocao.doanhthu', compact('totalOrders', 'totalRevenue') ,[
            'totalAmountByLoaiHang' => $totalAmountByLoaiHang,
            'allOuputForm' => $allOuputForm
        ]);
    }
}
