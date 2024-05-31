<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListShopping extends Model
{
    use HasFactory;

    protected $tableInvoice = 'tbl_hoadonxuat';
    // danh sách đơn hàng bán được theo thời gian
    // theo ngày 
    public function GetListInvoiceByDate($date){
        $sql = "SELECT *
                FROM " . $this->tableInvoice . "
                JOIN tbl_khachhang ON " . $this->tableInvoice . ".id_khachhang = tbl_khachhang.id_khachhang
                WHERE thoigian BETWEEN ? AND ?";

        $bindings = [$date . ' 00:00:00', $date . ' 23:59:59'];
        $results = DB::select($sql, $bindings);
        return $results;
    }

    // theo tháng 
    public function GetListInvoiceByMonth($year, $month){
        $sql = "SELECT * 
                FROM " . $this->tableInvoice . "
                JOIN tbl_khachhang ON " . $this->tableInvoice . ".id_khachhang = tbl_khachhang.id_khachhang
                WHERE thoigian BETWEEN ? AND ?";

        $binding = [$year.'-'.$month.'-1'.' 00:00:00', $year.'-'.$month.'-31'.' 23:59:59'];
        $results = DB::select($sql, $binding);
        return $results;
    }

    // theo năm
    public function GetListInvoiceByYear($year){
        $sql = "SELECT * 
                FROM " . $this->tableInvoice . "
                JOIN tbl_khachhang ON " . $this->tableInvoice . ".id_khachhang = tbl_khachhang.id_khachhang
                WHERE thoigian BETWEEN ? AND ?";

        $binding = [$year.'-1-1'.' 00:00:00', $year.'-12-31'.' 23:59:59'];
        $results = DB::select($sql, $binding);
        return $results;
    }
}
