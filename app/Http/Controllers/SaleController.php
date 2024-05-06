<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    //
    public function indexSales(){
        $totalAmount = DB::table('tbl_chitiethdx')
            ->select(DB::raw('SUM(soluong * giaxuat) as total_amount'))
            ->first();
        $totalAmountByLoaiHang = [];
        for ($i = 1; $i<=3; $i++) {
            $loaiHang = Category::query()->where("id_loaihang", $i)->first();
            $totalAmountByLoaiHang[$loaiHang->ten_loaihang] = DB::table('tbl_chitiethdx')
                ->join('tbl_sanpham', 'tbl_chitiethdx.id_sanpham', '=', 'tbl_sanpham.id_sanpham')
                ->select(DB::raw('SUM(tbl_chitiethdx.soluong * tbl_chitiethdx.giaxuat) as value'))
                ->where('tbl_sanpham.id_loaihang', '=', $i)
                ->first();
        }

        return view('manage.baocao.doanhthu', [
            'totalAmount' => $totalAmount,
            'totalAmountByLoaiHang' => $totalAmountByLoaiHang,
        ]);
    }
}
