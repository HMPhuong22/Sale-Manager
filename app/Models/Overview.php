<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Overview extends Model
{
    use HasFactory;
    public function topCustomersByMonth($month, $year) {
        $topCustomers = DB::table('tbl_hoadonxuat')
            ->select('tbl_khachhang.ten_khachhang', DB::raw('SUM(tonggiaxuat) as total_spent'))
            ->join('tbl_khachhang', 'tbl_hoadonxuat.id_khachhang', '=', 'tbl_khachhang.id_khachhang')
            ->whereBetween('thoigian', [$year.'-'.$month.'-1'.' 00:00:00', $year.'-'.$month.'-31'.' 23:59:59'])
            ->groupBy('tbl_khachhang.ten_khachhang')
            ->orderBy('total_spent', 'desc')
            ->limit(5)
            ->get();
    
        return $topCustomers;
    }
}
